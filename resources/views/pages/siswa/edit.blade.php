@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Data Master</li>
            <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Siswa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column">
                            <h6 class="card-title">Edit Data Siswa</h6>
                            <p class="text-muted mb-3">Ubah data siswa.</p>
                        </div>
                    </div>

                    <form action="{{ route('siswa.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Masukkan email"
                                name="email" value="{{ old('email') ?? $user->email }}">
                            @error('email')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Masukkan username"
                                name="username" value="{{ old('username') ?? $user->username }}">
                            @error('username')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="text" class="form-control" id="password" placeholder="Masukkan kata sandi"
                                name="password" value="{{ old('password') }}">
                            @error('password')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                            <input type="text" class="form-control" id="password_confirmation"
                                placeholder="Masukkan konfirmasi kata sandi" name="password_confirmation"
                                value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <hr class="my-3">

                        <div class="mb-3">
                            <label for="nama_siswa" class="form-label">Nama Lengkap Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa"
                                placeholder="Masukkan nama lengkap siswa" name="nama_siswa"
                                value="{{ old('nama_siswa') ?? $user->detail->nama_siswa }}">
                            @error('nama_siswa')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nis" class="form-label">NISN</label>
                            <input type="text" class="form-control" id="nis" placeholder="Masukkan nis siswa"
                                name="nis" value="{{ old('nis') ?? $user->detail->nis }}">
                            @error('nis')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" placeholder="Masukkan kelas siswa"
                                name="kelas" value="{{ old('kelas') ?? $user->detail->kelas }}">
                            @error('kelas')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat siswa">{{ old('alamat') ?? $user->detail->alamat }}</textarea>
                            @error('alamat')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_ortu" class="form-label">Nama Ortu</label>
                            <input type="text" class="form-control" id="nama_ortu"
                                placeholder="Masukkan nama orang tua siswa" name="nama_ortu"
                                value="{{ old('nama_ortu') ?? $user->detail->nama_ortu }}">
                            @error('nama_ortu')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tlp_ortu" class="form-label">Telpon Orang Tua</label>
                            <input type="text" class="form-control" id="tlp_ortu"
                                placeholder="Masukkan telpon orang tua siswa" name="tlp_ortu"
                                value="{{ old('tlp_ortu') ?? $user->detail->tlp_ortu }}">
                            @error('tlp_ortu')
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
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
