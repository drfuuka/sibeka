@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Pengguna</li>
            <li class="breadcrumb-item"><a href="{{ route('guru.index') }}">Guru</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column">
                            <h6 class="card-title">Tambah Data Guru</h6>
                            <p class="text-muted mb-3">Tambahkan data guru.</p>
                        </div>
                    </div>

                    <form action="{{ route('guru.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Masukkan email"
                                name="email" value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Masukkan username"
                                name="username" value="{{ old('username') }}">
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

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" data-width="100%" name="role">
                                <option disabled selected>Pilih role</option>
                                <option {{ old('role') === 'Guru' ? 'selected' : '' }} value="Guru">Guru</option>
                                <option {{ old('role') === 'BK' ? 'selected' : '' }} value="BK">BK</option>
                                <option {{ old('role') === 'Kepala Sekolah' ? 'selected' : '' }} value="Kepala Sekolah">
                                    Kepala Sekolah</option>
                            </select>
                            @error('role')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <hr class="my-3">

                        <div class="mb-3">
                            <label for="nama_guru" class="form-label">Nama Lengkap Guru</label>
                            <input type="text" class="form-control" id="nama_guru"
                                placeholder="Masukkan nama lengkap guru" name="nama_guru" value="{{ old('nama_guru') }}">
                            @error('nama_guru')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" placeholder="Masukkan nip guru"
                                name="nip" value="{{ old('nip') }}">
                            @error('nip')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat guru">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input type="text" class="form-control" id="no_hp" placeholder="Masukkan no hp guru"
                                name="no_hp" value="{{ old('no_hp') }}">
                            @error('no_hp')
                                <small class="text-danger" role="alert">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan"
                                placeholder="Masukkan jabatan guru" name="jabatan" value="{{ old('jabatan') }}">
                            @error('jabatan')
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
