<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Jenis;
use App\Models\Lokasi;
use App\Models\Sirkulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::select("*")
            ->orderBy('created_at', "desc")
            ->get();
        $jenis = Jenis::all();
        $lokasi = Lokasi::all();
        $sirkulasi = Sirkulasi::all();
        return view('Barang.index', compact('barang', 'jenis', 'lokasi', 'sirkulasi'));
    }
    public function create()
    {
        $jenis = Jenis::all();
        $lokasi = Lokasi::all();
        return view('barang.create', compact('jenis', 'lokasi'));
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_pemilik' => 'required',
                'kelas_pemilik' => 'required',
                'jenis_barang' => 'required',
                'merk_barang' => 'required',
                'lokasi_barang' => 'required',
            ],
            [
                'nama_pemilik.required' => 'Nama Tidak Boleh Kosong.',
                'kelas_pemilik.required' => 'Kelas Tidak Boleh Kosong.',
                'jenis_barang.required' => 'Jenis Tidak Boleh Kosong.',
                'merk_barang.required' => 'Merk Tidak Boleh Kosong.',
                'lokasi_barang.required' => 'Lokasi Tidak Boleh Kosong.',
            ]
        );

        $barang = Barang::create([
            'nama_pemilik' => $request->nama_pemilik,
            'kelas_pemilik' => $request->kelas_pemilik,
            'jenis_barang' => $request->jenis_barang,
            'merk_barang' => $request->merk_barang,
            'lokasi_barang' => $request->lokasi_barang,
            'user_id' => auth()->user()->id,
        ]);

        $sir = Sirkulasi::create([
            'barang_id' => $barang->id,
            'status' => 'titip',
            'user_id' => auth()->user()->id,
        ]);

        return redirect('barang')->with('message', 'Data Barang Telah Disimpan');
    }
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect('barang')->with('message', 'Data Barang Telah Dihapus');
    }
}
