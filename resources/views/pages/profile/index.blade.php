@extends('layout.master')

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Profile</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column">
                            <h6 class="card-title">Profile</h6>
                            <p class="text-muted mb-3">Lihat detail data profile kamu.</p>
                        </div>
                    </div>

                    <form action="{{ route('profile.update', $user->id) }}" method="POST">
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

                        @if (Auth::user()->role !== 'Admin')
                            <hr class="my-3">
                        @endif

                        @if (Auth::user()->role === 'Siswa')
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
                        @elseif (Auth::user()->role !== 'Admin')
                            <div class="mb-3">
                                <label for="nama_guru" class="form-label">Nama Lengkap Guru</label>
                                <input type="text" class="form-control" id="nama_guru"
                                    placeholder="Masukkan nama lengkap guru" name="nama_guru"
                                    value="{{ old('nama_guru') ?? $user->detail->nama_guru }}">
                                @error('nama_guru')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="nip"
                                    placeholder="Masukkan nip guru" name="nip"
                                    value="{{ old('nip') ?? $user->detail->nip }}">
                                @error('nip')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan alamat guru">{{ old('alamat') ?? $user->detail->alamat }}</textarea>
                                @error('alamat')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" class="form-control" id="no_hp"
                                    placeholder="Masukkan no hp guru" name="no_hp"
                                    value="{{ old('no_hp') ?? $user->detail->no_hp }}">
                                @error('no_hp')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan"
                                    placeholder="Masukkan jabatan guru" name="jabatan"
                                    value="{{ old('jabatan') ?? $user->detail->jabatan }}">
                                @error('jabatan')
                                    <small class="text-danger" role="alert">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        @endif

                        <div class="d-flex">
                            <button class="btn btn-primary ms-auto">Simpan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
