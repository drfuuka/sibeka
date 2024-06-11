@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Data Master</li>
            <li class="breadcrumb-item"><a href="{{ route('jenis-pelanggaran.index') }}">Jenis Pelanggaran</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column">
                            <h6 class="card-title">Edit Jenis Pelanggaran</h6>
                            <p class="text-muted mb-3">Ubah data jenis pelanggaran.</p>
                        </div>
                    </div>

                    <form action="{{ route('jenis-pelanggaran.update', $jenisPelanggaran->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="jenis_pelanggaran" class="form-label">Jenis Pelanggaran</label>
                            <input type="text" class="form-control" id="jenis_pelanggaran"
                                placeholder="Masukkan jenis_pelanggaran" name="jenis_pelanggaran"
                                value="{{ old('jenis_pelanggaran') ?? $jenisPelanggaran->jenis_pelanggaran }}">
                            @error('jenis_pelanggaran')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="poin" class="form-label">Poin</label>
                            <input type="text" class="form-control" id="poin" placeholder="Masukkan poin"
                                name="poin" value="{{ old('poin') ?? $jenisPelanggaran->poin }}">
                            @error('poin')
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
