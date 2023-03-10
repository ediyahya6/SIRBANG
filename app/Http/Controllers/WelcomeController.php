<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\Sirkulasi;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $sirkulasi = Sirkulasi::all();
        $barang = Barang::all();
        $lokasi = Lokasi::all();

        return view('welcome', compact(
            'sirkulasi',
            'barang',
            'lokasi'
        ));
    }
}
