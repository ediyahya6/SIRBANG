<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\Sirkulasi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $barang = Barang::all();
        $lokasi = Lokasi::all();

        return view('home.index', compact(
            'barang',
            'lokasi',
        ));
    }
    public function detail($id)
    {
        $barang = Barang::find($id);

        // Histori Sirkulasi Berdasarkan id
        $history = Sirkulasi::where('barang_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Status Sirkulasi Terakhir
        $satset = Sirkulasi::where('barang_id', $id)
            ->latest()
            ->first();

        return view('home.detail', compact(
            'barang',
            'history',
            'satset',
        ));
    }
    /// Funtion Create Setting Jenis
    public function sirkulasi(Request $request)
    {
        Sirkulasi::create([
            'barang_id' => $request->barang_id,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back();
    }
}
