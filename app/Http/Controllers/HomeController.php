<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use App\Models\Kegiatan;
use App\Models\JenisBantuan;
use App\Models\TujuanDonasi;
use Illuminate\Http\Request;

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

    public function donasi()
    {
        return view('pages.donasi');
    }

    public function about()
    {
        return view('pages.about');
    }
}
