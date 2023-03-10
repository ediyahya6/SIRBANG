@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="col-md-4">
            <div class="row card mb-2 text-white bg-dark">
                <h2 class="text-center mb-2 mt-2">{{$barang->lokasi_barang}}</h2>
            </div>
            <div class="row card mb-2 ">
                <div class="card-body">
                    <h5 align="center"><b>DATA PEMILIK & BARANG</b></h5>
                    <hr>
                    <div class="row">
                        <label class="col-md-3">Nama</label>
                        <div class="col-md-9">: {{$barang->nama_pemilik}}</div>
                        <label class="col-md-3">Kelas</label>
                        <div class="col-md-9">: {{$barang->kelas_pemilik}}</div>
                        <label class="col-md-3">Jenis</label>
                        <div class="col-md-9">: {{$barang->jenis_barang}}</div>
                        <label class="col-md-3">Merk</label>
                        <div class="col-md-9">: {{$barang->merk_barang}}</div>
                    </div>
                    <br>
                    <div class="row">
                        <h5 align="center"><b>STATUS </b>
                            <span class="badge bg-dark mt-1 mb-1 p-2">
                                @if ($satset->status === "titip")
                                PENITIPAN
                                @elseif ($satset->status === "ambil")
                                PENGAMBILAN
                                @else
                                SITA !!
                                <br> Sampai <b>{{$satset->keterangan}}</b>
                                @endif
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white bg-dark">
                    <h4>History Sirkulasi
                        <div class="float-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalManual">
                                SIRKULASI
                            </button>
                        </div>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="detailhistory" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>TANGGAL</th>
                                    <th>KETERANGAN</th>
                                    <th>PETUGAS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($history as $his)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$his->created_at->format('d/m/Y - H:i')}}</td>
                                    <td>
                                        @if ($his->status === "titip")
                                        PENITIPAN
                                        @elseif ($his->status === "ambil")
                                        PENGAMBILAN
                                        @else
                                        SITA !!
                                        <br> Sampai <b>{{$his->keterangan}}</b>
                                        @endif
                                    </td>
                                    <td>{{$his->user->name}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalManual" tabindex="-1" aria-labelledby="ModalManual" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalManual">PEMBERITAHUAN !!!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" align="center">
                <h5><b>Status Barang Terkini : </b>
                    @if ($satset->status === "titip")
                    <b>Tersedia / Telah Dikembalikan</b>
                    @elseif ($satset->status === "ambil")
                    <b>Tidak Tersedia / Telah diambil</b>
                    @else
                    <b>Sedang di SITA !!</b>
                    @endif
                </h5>
                <form action="{{ url('barang/{id}/sirkulasi') }}" method="POST">
                    @csrf
                    <h5>
                        @if ($satset->status === "titip")
                        Apakah Anda ingin melakukan proses
                        <span class="badge bg-success mt-1 mb-1 p-2">PEMINJAMAN</span>
                        <br>
                        <input type="hidden" name="barang_id" value="{{$barang->id}}" class="form-control">
                        <input type="hidden" name="status" value="ambil" class="form-control">
                        @elseif ($satset->status === "ambil")
                        Apakah Anda ingin melakukan proses
                        <span class="badge bg-warning mt-1 mb-1 p-2">PENGEMBALIAN</span>
                        <br>
                        <input type="hidden" name="barang_id" value="{{$barang->id}}" class="form-control">
                        <input type="hidden" name="status" value="titip" class="form-control">
                        @else
                        Tidak dapat melakukan peminjaman
                        <br> Sampai <b>{{$satset->keterangan}}</b>
                        @endif
                    </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Iya</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    $(document).ready(function() {
        $('#detailhistory').DataTable();
    });
</script>
@endpush
@endsection