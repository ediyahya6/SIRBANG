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
                    <h4>Laporan History Sirkulasi
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#ModalManual">
                            Reset Sirkulasi Manual
                        </button>
                    </h4>
                </div>
                <div class="card-body table-responsive">
                    <table id="sirkulasi" class="table table-bordered">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Barang</th>
                                <th>Pemilik</th>
                                <th>Status Sirkulasi</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sirkulasi as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->created_at->format('d/m/Y - H:i')}}</td>
                                <td>{{$item->barang->jenis_barang}} - <b>{{$item->barang->merk_barang}}</b></td>
                                <td><b>{{$item->barang->nama_pemilik}}</b> - {{$item->barang->kelas_pemilik}}</td>
                                <td>
                                    @if ($item->status === "titip")
                                    <button class="btn btn-success btn-sm">Penitipan</button>
                                    @elseif ($item->status === "ambil")
                                    <button class="btn btn-primary btn-sm">Pengambilan</button>
                                    @else
                                    <button class="btn btn-danger btn-sm">Disita!!</button>
                                    <br> Sampai <b>{{$item->keterangan}}</b>
                                    @endif
                                </td>
                                <td>{{$item->user->name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalManual" tabindex="-1" aria-labelledby="ModalManual" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalManual">Reset Sirkulasi Manual</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('sirkulasi/create') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Nama Pemilik</label>
                        <select name="barang_id" class="form-control">
                            <option selected disabled value="">Pilih Nama Pemilik Barang</option>
                            @foreach ($barang as $tam)
                            <option value="{{ $tam->id }}">{{ $tam->nama_pemilik }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Status Sirkulasi</label>
                        <select name="status" class="form-control" onchange="checkStatus();">
                            <option selected disabled value="">Pilih Status Sirkulasi</option>
                            <option value="titip">Penitipan</option>
                            <option value="ambil">Pengambilan</option>
                            <option value="sita" id="ketSita">Disita</option>
                        </select>
                    </div>

                    <div class="mb-3" id="keterangan" style="display:none">
                        <label>Batas Waktu Sita</label>
                        <input type="date" name="keterangan" class="form-control">
                    </div>

                    <script>
                        function checkStatus() {
                            var ketSita = document.getElementById("ketSita").selected;
                            if (ketSita == true) {
                                document.getElementById("keterangan").removeAttribute("style");
                            } else {
                                document.getElementById("keterangan").style.display = "none";
                            }
                        }
                    </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    $(document).ready(function() {
        $('#sirkulasi').DataTable();
    });
</script>
@endpush
@endsection