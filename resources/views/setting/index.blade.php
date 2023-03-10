@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      @if (session('message'))
      <div class="alert alert-success">{{ session('message') }}</div>
      @endif
    </div>
  </div>
  <div class="row">
    <div class="col-md-5 mt-1 mb-1">
      <div class="card">
        <div class="card-header">
          <h4>Jenis Barang
            <a class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modaljenis">Tambah</a>
          </h4>
        </div>
        <div class="card-body">
          <ol class="list-group list-group-numbered">
            @foreach ($jenis as $jen)
            <li class="list-group-item">{{$jen->nama}}</li>
            @endforeach
          </ol>
        </div>
      </div>
    </div>
    <div class="col-md-7 mt-1 mb-1">
      <div class="card">
        <div class="card-header">
          <h4>Lokasi Penyimpanan
            <a class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modallokasi">Tambah</a>
          </h4>
        </div>
        <div class="card-body">
          <div class="d-grid gap-2 d-md-block">
            @foreach ($lokasi as $lok)
            <div class="btn btn-primary mb-2">{{$lok->nama}}</div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Jenis-->
<div class="modal fade" id="modaljenis" tabindex="-1" aria-labelledby="modaljenis" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaljenis">Tambah Jenis</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ url('setting/jenis') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label>Jenis Barang</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror">
            @error('nama')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Lokasi-->
<div class="modal fade" id="modallokasi" tabindex="-1" aria-labelledby="modallokasi" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaljenis">Tambah Lokasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ url('setting/lokasi') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label>Lokasi Penyimpanan</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror">
            @error('nama')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection