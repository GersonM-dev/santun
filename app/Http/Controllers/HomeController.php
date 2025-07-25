<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Money;
use App\Models\Donasi;
use App\Models\Satuan;
use App\Models\Kegiatan;
use App\Models\JenisBantuan;
use App\Models\TujuanDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('date', 'desc')->take(4)->get();
        return view('pages.home', compact('kegiatans'));
    }

    public function kegiatan()
    {
        $kegiatans = Kegiatan::orderBy('date', 'desc')->paginate(8);
        return view('pages.kegiatan', compact('kegiatans'));
    }

    public function detailkegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('pages.detail-kegiatan', compact('kegiatan'));
    }

    public function formlayanan()
    {
        $jenisBantuanList = JenisBantuan::all(); // Model sesuai relasi di Select::make
        return view('pages.form-layanan', compact('jenisBantuanList'));
    }

    public function submitLayanan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'date_birth' => 'required|date',
            'id_jenisBantuan' => 'required|exists:jenis_bantuans,id',
            'kontak' => 'required|string|max:100',
            'keluhan' => 'required|string|max:1000',
            'alamat' => 'required|string|max:1000',
            'status' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        // Store the bantuan request
        $bantuan = \App\Models\Bantuan::create([
            'nama' => $request->nama,
            'date_birth' => $request->date_birth,
            'id_jenisBantuan' => $request->id_jenisBantuan,
            'kontak' => $request->kontak,
            'keluhan' => $request->keluhan,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
        ]);

        $cust = [
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'keluhan' => $request->keluhan,
            'tanggal' => $request->tanggal,
            'jenis_bantuan' => \App\Models\JenisBantuan::find($request->id_jenisBantuan)->name,
            'status' => $request->status,
        ];

        // Notify via WhatsApp
        $this->notifyViaWhatsapp($cust, $bantuan->id);

        return redirect()->back()->with('success', 'Permohonan bantuan berhasil diajukan!');
    }

    public function layanan()
    {
        return view('pages.layanan');
    }

    public function formdonasi()
    {
        $tujuanDonasiList = TujuanDonasi::all();
        $satuanList = Satuan::all();
        return view('pages.form-donasi', compact('tujuanDonasiList', 'satuanList'));

    }

    public function submitDonasi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'date' => 'required|date',
            'type' => 'required|in:Materi,Non Materi',
            'tujuan_donasi_id' => 'required|exists:tujuan_donasis,id',
            'is_anonymous' => 'nullable|boolean',

            // Materi validation
            'money_total' => 'required_if:type,Materi|nullable|numeric|min:1',
            'money_proof_picture' => 'required_if:type,Materi|nullable|image|max:2048',

            // Non Materi validation
            'item_name' => 'required_if:type,Non Materi|nullable|string|max:255',
            'quantity' => 'required_if:type,Non Materi|nullable|integer|min:1',
            'satuan_id' => 'required_if:type,Non Materi|nullable|exists:satuans,id',
        ]);

        // Store the Donasi record
        $donasi = Donasi::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
            'type' => $request->type,
            'tujuan_donasi_id' => $request->tujuan_donasi_id,
            'is_anonymous' => $request->boolean('is_anonymous'),
        ]);

        if ($request->type === 'Materi') {
            $proofPicturePath = null;
            if ($request->hasFile('money_proof_picture')) {
                $proofPicturePath = $request->file('money_proof_picture')->store('donasi/proof', 'public');
            }

            Money::create([
                'donasi_id' => $donasi->id,
                'total' => $request->money_total,
                'proof_picture' => $proofPicturePath,
            ]);
        }

        if ($request->type === 'Non Materi') {
            Item::create([
                'donasi_id' => $donasi->id,
                'name' => $request->item_name,
                'qty' => $request->quantity,
                'satuan_id' => $request->satuan_id,
            ]);
        }

        // Build WhatsApp notification data
        $cust = [
            'nama' => $request->name,
            'phone' => $request->phone,
            'type' => $request->type,
            'tanggal' => $request->date,
            'tujuan_donasi' => TujuanDonasi::find($request->tujuan_donasi_id)->name,
            'is_anonymous' => $request->boolean('is_anonymous') ? 'Ya' : 'Tidak',
            'status' => isset($request->status) ? $request->status : 'Terkirim',
        ];

        if ($request->type === 'Materi') {
            $cust['money_total'] = $request->money_total;
        } elseif ($request->type === 'Non Materi') {
            $cust['item_name'] = $request->item_name;
            $cust['quantity'] = $request->quantity;
            $cust['satuan'] = Satuan::find($request->satuan_id)->name;
        }

        // Notify via WhatsApp
        $this->notifyViaWhatsapp($cust, $donasi->id);

        return redirect()->back()->with('success', 'Terima kasih! Donasi Anda berhasil dikirim.');
    }

    public function donasi()
    {
        return view('pages.donasi');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function showprofile()
    {
        $user = Auth::user();
        return view('pages.profile', compact('user'));
    }

    public function updateprofile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|confirmed|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = $request->password;
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated!');
    }

    private function notifyViaWhatsapp(array $cust, int $txId): void
    {
        try {
            // Pick phone for Donasi, kontak for Layanan
            $phone = $cust['phone'] ?? ($cust['kontak'] ?? null);

            if (!$phone) {
                Log::error('No phone number for WhatsApp notification.');
                return;
            }

            $intl = (substr($phone, 0, 1) === '0') ? '62' . substr($phone, 1) : $phone;

            // Build a dynamic message for Donasi
            if (isset($cust['tujuan_donasi'])) {
                $msg = "Donasi Baru!\n"
                    . "Nama: {$cust['nama']}\n"
                    . "Tanggal: {$cust['tanggal']}\n"
                    . "Tujuan: {$cust['tujuan_donasi']}\n"
                    . "Jenis: {$cust['type']}\n";

                if ($cust['type'] === 'Materi') {
                    $msg .= "Nominal: Rp" . number_format($cust['money_total'] ?? 0, 0, ',', '.') . "\n";
                } elseif ($cust['type'] === 'Non Materi') {
                    $msg .= "Barang: {$cust['item_name']}\n"
                        . "Jumlah: {$cust['quantity']} {$cust['satuan']}\n";
                }

                $msg .= "Anonim: {$cust['is_anonymous']}\n"
                    . "Status: {$cust['status']}\n";
            }
            // Build a message for Layanan
            else {
                $msg = "Permohonan Bantuan Baru!\n"
                    . "Nama: {$cust['nama']}\n"
                    . "Tanggal: {$cust['tanggal']}\n"
                    . "Jenis Bantuan: {$cust['jenis_bantuan']}\n"
                    . "Kontak: {$cust['kontak']}\n"
                    . "Keluhan: {$cust['keluhan']}\n"
                    . "Status: {$cust['status']}\n";
            }

            $msg .= "No HP: https://wa.me/{$intl}\n"
                . "ID Transaksi: {$txId}";

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => [
                    'target' => '085591305808', // <-- Change to $intl if you want to notify the customer, or keep as admin number for notifications.
                    'message' => $msg,
                    'countryCode' => '62',
                ],
                CURLOPT_HTTPHEADER => ['Authorization: 1DE6DXXKg79mL8ivtLkK'],
            ]);
            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                Log::error('Fonnte error: ' . curl_error($curl));
            }
            curl_close($curl);
            Log::info('Fonnte response: ' . $response);
        } catch (\Throwable $e) {
            Log::error('WhatsApp notification failed: ' . $e->getMessage());
        }
    }

}
