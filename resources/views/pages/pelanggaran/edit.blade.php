@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/pelanggaran">Pelanggaran</a></li>
            <li class="breadcrumb-item" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column">
                            <h6 class="card-title">Edit Data Pelanggaran</h6>
                            <p class="text-muted mb-3">Ubah data pelanggaran siswa.</p>
                        </div>
                    </div>

                    <form action="{{ route('pelanggaran.update', $pelanggaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Nama Siswa</label>
                            <select class="js-example-basic-single form-select" data-width="100%" name="user_id">
                                <option value="" disabled selected>Pilih nama siswa</option>
                                @foreach ($daftarSiswa as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id === old('user_id') || $item->id === $pelanggaran->user_id ? 'selected' : '' }}>
                                        {{ $item->detail->nama_siswa }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <div class="input-group date datepicker" id="datePickerExample">
                                <input type="text" class="form-control" name="tanggal"
                                    value="{{ old('tanggal') ?? $pelanggaran->tanggal }}">
                                <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                            </div>
                            @error('tanggal')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_pelanggaran" class="form-label">Jenis Pelanggaran</label>
                            <select class="js-example-basic-single form-select" data-width="100%"
                                name="jenis_pelanggaran_id" id="jenis_pelanggaran">
                                <option disabled selected>Pilih jenis pelanggaran</option>
                                @foreach ($jenisPelanggaran as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id === old('jenis_pelanggaran_id') ? 'selected' : '' }}>
                                        {{ $item->jenis_pelanggaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="poin" class="form-label">Poin Pelanggaran</label>
                            <input type="number" class="form-control" id="poin"
                                placeholder="Pilih jenis pelanggaran dahulu" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="pelapor" class="form-label">Nama Pelapor</label>
                            <input type="text" class="form-control" id="pelapor" placeholder="Tuliskan nama pelapor"
                                name="pelapor" value="{{ old('pelapor') ?? $pelanggaran->pelapor }}">
                            @error('pelapor')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="d-flex">
                            <button class="btn btn-primary ms-auto">Simpan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush

@section('script')
    <script>
        $(document).ready(function() {
            function handleJenisPelanggaranChange(val) {
                $.ajax({
                    url: `/pelanggaran/${val}/poin`,
                    success: function(result) {
                        $('#poin').val(result)
                    },
                })
            }

            $('#jenis_pelanggaran').on('change', function() {
                var jenisPelanggaranId = $(this).val();
                handleJenisPelanggaranChange(jenisPelanggaranId)
            })
        })
    </script>
@endsection
