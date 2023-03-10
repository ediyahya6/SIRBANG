<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $jenis = Jenis::all();
        $lokasi = Lokasi::all();
        return view('setting.index', compact('jenis', 'lokasi'));
    }

    /// Funtion Create Setting Jenis
    public function create1(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
            ],
            [
                'nama.required' => 'Jenis Tidak Boleh Kosong.',
            ]
        );
        Jenis::create([
            'nama' => $request->nama,
        ]);

        return redirect('setting')->with('message', 'Jenis Barang Berhasil Ditambahkan');
    }
    /// Funtion Create Setting Lokasi
    public function create2(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
            ],
            [
                'nama.required' => 'Lokasi Tidak Boleh Kosong.',
            ]
        );
        Lokasi::create([
            'nama' => $request->nama,
        ]);

        return redirect('setting')->with('message', 'Lokasi Barang Berhasil Ditambahkan');
    }
}
