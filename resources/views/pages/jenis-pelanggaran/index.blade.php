@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Data Master</li>
            <li class="breadcrumb-item active" aria-current="page">Jenis Pelanggaran</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column">
                            <h6 class="card-title">Jenis Pelanggaran</h6>
                            <p class="text-muted mb-3">List data jenis pelanggaran.</p>
                        </div>
                        <a class="btn btn-primary" href="{{ route('jenis-pelanggaran.create') }}">Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Jenis Pelanggaran</th>
                                    <th>Poin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenisPelanggaran as $item)
                                    <tr>
                                        <td>{{ $item->jenis_pelanggaran }}</td>
                                        <td>{{ $item->poin }}</td>

                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('jenis-pelanggaran.edit', $item->id) }}"
                                                    class="btn btn-primary btn-sm"><i data-feather="pencil"
                                                        width="15"></i></i>
                                                    Edit</button>
                                                </a>
                                                <form action="{{ route('jenis-pelanggaran.destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            data-feather="trash-2" width="15"></i></i>
                                                        Hapus</button>
                                                </form>
                                            </div>
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
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
