@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-4" style="max-width: 600px;">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h3 class="mb-4 text-center">Daftar Akun</h3>
            
            <form method="POST" action="{{ route('register.step1.post') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Aktif</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" name="password" required>
                    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-dark">Lanjut</button>
                </div>
            </form>

            <div class="text-center">
                <hr class="my-4">
                <a href="{{ route('google.redirect') }}" class="btn btn-danger w-100">
                    <i class="fab fa-google me-2"></i> Daftar dengan Google
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
