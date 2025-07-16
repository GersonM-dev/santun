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
        \App\Models\Bantuan::create([
            'nama' => $request->nama,
            'date_birth' => $request->date_birth,
            'id_jenisBantuan' => $request->id_jenisBantuan,
            'kontak' => $request->kontak,
            'keluhan' => $request->keluhan,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'tanggal' => $request->tanggal,
        ]);

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
}
