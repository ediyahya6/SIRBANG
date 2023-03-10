@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Data Barang
                        <a href="{{ url('barang' )}}" class="btn btn-primary float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{ url('barang') }}" method="POST">
                        @csrf

                        <label>Data Pemilik</label>
                        <div class="col-md-6">
                            <input type="text" value="{{ old('nama_pemilik') }}" name="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror" placeholder="Nama Pemilik">
                            @error('nama_pemilik')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <input type="text" value="{{ old('kelas_pemilik') }}" name="kelas_pemilik" class="form-control @error('kelas_pemilik') is-invalid @enderror" placeholder="Kelas Pemilik">
                            @error('kelas_pemilik')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <label>Data Barang</label>
                        <div class="col-md-6">
                            <select name="jenis_barang" class="form-control @error('jenis_barang') is-invalid @enderror">
                                <option selected disabled value="">Pilih Jenis Barang</option>
                                @foreach ($jenis as $item)
                                <option value="{{ $item->nama }}" {{ old('jenis_barang') ==  $item->nama  ? 'selected' : '' }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('jenis_barang')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="text" value="{{ old('merk_barang') }}" name="merk_barang" class="form-control @error('merk_barang') is-invalid @enderror" placeholder="Merk Barang">
                            @error('merk_barang')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <select name="lokasi_barang" class="form-control @error('lokasi_barang') is-invalid @enderror">
                                <option selected disabled value="">Pilih Lokasi</option>
                                @foreach ($lokasi as $lok)
                                    @php
                                        $jumb = App\Models\Barang::where('lokasi_barang', $lok->nama)->get()
                                    @endphp

                                    @if (count($jumb) < 2)
                                        <option value="{{ $lok->nama }}">{{ $lok->nama }}</option>
                                    @else
                                        <option disabled>{{ $lok->nama }} - Penuh</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('lokasi_barang')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection