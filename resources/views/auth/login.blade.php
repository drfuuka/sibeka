@extends('layout.master2')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pe-md-0">
                            <div class="auth-side-wrapper"
                                style="background-image: url({{ url('https://img.freepik.com/free-vector/interview-concept-illustration_114360-1501.jpg?w=2000') }})">

                            </div>
                        </div>
                        <div class="col-md-8 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <a href="#" class="noble-ui-logo d-block mb-2">Sibeka</a>
                                <h5 class="text-muted fw-normal mb-4">Selamat datang kemabli! Login untuk akses akun kamu.
                                </h5>
                                <form class="forms-sample" action="{{ route('login.authenticate') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Email / Username</label>
                                        <input type="text" class="form-control" id="userEmail" placeholder="Email"
                                            name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <small class="text-danger" role="alert">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Kata Sandi</label>
                                        <input type="password" class="form-control" id="userPassword"
                                            autocomplete="current-password" placeholder="Password" name="password"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <small class="text-danger" role="alert">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary me-2 mb-2 mb-md-0" role="button">Login</button>
                                    </div>

                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
