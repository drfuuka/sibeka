@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Pengguna</li>
            <li class="breadcrumb-item active" aria-current="page">Guru</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column">
                            <h6 class="card-title">Data Guru</h6>
                            <p class="text-muted mb-3">List data guru.</p>
                        </div>
                        @if (Auth::user()->role === 'Admin')
                            <a class="btn btn-primary" href="{{ route('guru.create') }}">Tambah</a>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>Jabatan</th>
                                    <th>Role</th>
                                    @if (Auth::user()->role === 'Admin')
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guru as $item)
                                    <tr>
                                        <td>{{ $item->detail->nama_guru }}</td>
                                        <td>{{ $item->detail->nip }}</td>
                                        <td>{{ $item->detail->alamat }}</td>
                                        <td>{{ $item->detail->no_hp }}</td>
                                        <td>{{ $item->detail->jabatan }}</td>
                                        <td>{{ $item->role }}</td>

                                        @if (Auth::user()->role === 'Admin')
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('guru.edit', $item->id) }}"
                                                        class="btn btn-primary btn-sm"><i data-feather="pencil"
                                                            width="15"></i></i>
                                                        Edit</button>
                                                    </a>
                                                    <form action="{{ route('guru.destroy', $item->id) }}" method="POST">
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
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
