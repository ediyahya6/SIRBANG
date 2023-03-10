@extends('layouts.app')

@section('content')
<div class="container">
  @if($lokasi->isNotEmpty())
  <div class="row justify-content-center">
    @foreach ($lokasi as $lok)
    <div class="col-md-3 mt-1 mb-1">
      <div class="card">
        <div class="card-header text-white bg-dark" align="center">
          <b>{{$lok->nama}}</b>
        </div>
        <div class="card-body bg-light ">
          <div class="d-grid gap-2">
            @foreach ($barang as $bar)
            @if ($bar->lokasi_barang === $lok->nama)
            <a class="btn btn-light" type="button" href="/barang/{{$bar->id}}/detail">
              {{$bar->nama_pemilik}}
            </a>
            @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @elseif ($lokasi->isEmpty())

  <h1 align="center"><b>PERHATIAN !!!<b></h1>
  <hr>
  @if ( Auth::user()->role_id != 1 )
  <h3 align="center">Admin belum melakukan Setting pada Data</h3>
  @else
  <h3 align="center">Silahkan Setting Data terlebih dahulu,
    <br>di Menu Setting Data
  </h3>
  @endif
  @endif
</div>
@endsection