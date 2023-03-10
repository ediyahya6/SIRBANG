@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Data Barang
                        <a href="{{ url('barang/create' )}}" class="btn btn-primary float-end">Tambah Data</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table id="barang" class="table table-bordered">
                        <thead>
                            <tr align="center">
                                <th></th>
                                <th>LOKASI</th>
                                <th>NAMA</th>
                                <th>KELAS</th>
                                <th>BARANG</th>
                                <th>PETUGAS</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->lokasi_barang}}</td>
                                <td>{{$item->nama_pemilik}}</td>
                                <td>{{$item->kelas_pemilik}}</td>
                                <td>{{$item->jenis_barang}} - <b>{{$item->merk_barang}}</b></td>
                                <td>{{$item->user->name}}</td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="/barang/{{$item->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="" class="btn btn-warning">Edit</a>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    $(document).ready(function() {
        $('#barang').DataTable();
    });
</script>
@endpush
@endsection