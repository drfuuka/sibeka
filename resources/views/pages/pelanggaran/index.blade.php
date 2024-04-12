@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Pengguna</li>
            <li class="breadcrumb-item active" aria-current="page">Siswa</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column">
                            <h6 class="card-title">Data Siswa</h6>
                            <p class="text-muted mb-3">List data pelanggaran.</p>
                        </div>

                        <div class="d-flex gap-3 align-items-center">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="link-icon me-1" data-feather="printer" width="18"></i>
                                Cetak Laporan
                            </button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="btn-close"></button>
                                        </div>
                                        <form action="{{ route('pelanggaran.cetak') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="dari_tanggal" class="form-label">Dari Tanggal</label>
                                                        <div class="input-group date datepicker" id="dari_tanggal">
                                                            <input type="text" class="form-control" name="dari_tanggal"
                                                                placeholder="Pilih tanggal"
                                                                value="{{ old('dari_tanggal') }}">
                                                            <span class="input-group-text input-group-addon"><i
                                                                    data-feather="calendar"></i></span>
                                                        </div>
                                                        @error('dari_tanggal')
                                                            <small class="text-danger" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="sampai_tanggal" class="form-label">Sampai
                                                            Tanggal</label>
                                                        <div class="input-group date datepicker" id="sampai_tanggal">
                                                            <input type="text" class="form-control" name="sampai_tanggal"
                                                                placeholder="Pilih tanggal"
                                                                value="{{ old('sampai_tanggal') }}">
                                                            <span class="input-group-text input-group-addon"><i
                                                                    data-feather="calendar"></i></span>
                                                        </div>
                                                        @error('sampai_tanggal')
                                                            <small class="text-danger" role="alert">
                                                                {{ $message }}
                                                            </small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Cetak</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @if (Auth::user()->role === 'BK')
                                <a class="btn btn-primary" href="{{ route('pelanggaran.create') }}">Tambah</a>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Kelas</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Pelanggaran</th>
                                    <th>Poin</th>
                                    <th>Pelapor</th>

                                    @if (Auth::user()->role === 'BK')
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelanggaran as $item)
                                    <tr>
                                        <td>{{ $item->siswa->detail->nama_siswa }}</td>
                                        <td>{{ $item->siswa->detail->nis }}</td>
                                        <td>{{ $item->siswa->detail->kelas }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->jenis_pelanggaran }}</td>
                                        <td>{{ $item->poin }}</td>
                                        <td>{{ $item->pelapor }}</td>
                                        @if (Auth::user()->role === 'BK')
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('pelanggaran.edit', $item->id) }}"
                                                        class="btn btn-primary btn-sm"><i data-feather="pencil"
                                                            width="15"></i></i>
                                                        Edit</button>
                                                    </a>
                                                    <form action="{{ route('pelanggaran.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                data-feather="trash-2" width="15"></i></i>
                                                            Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script>
        $(document).ready(function() {
            if ($("#dari_tanggal").length) {
                $("#dari_tanggal").datepicker({
                    format: "mm/dd/yyyy",
                    todayHighlight: true,
                    autoclose: true,
                });
            }

            if ($("#sampai_tanggal").length) {
                $("#sampai_tanggal").datepicker({
                    format: "mm/dd/yyyy",
                    todayHighlight: true,
                    autoclose: true,
                });
            }
        })
    </script>
@endpush
