@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    @foreach ($lokasi as $lok)
    <div class="col-md-3 mt-1 mb-1">
      <div class="card text-dark bg-info ">
        <div class="card-header text-white " align="center">
            <b>{{$lok->nama}}</b>
        </div>
        <ul class="list-group list-group-flush">
          @foreach ($barang as $bar)
            @if ($bar->lokasi_barang === $lok->nama)
              <li class="list-group-item">{{$bar->nama_pemilik}}</li>
            @endif
          @endforeach
        </ul>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection