@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h3 class="mb-3 text-center">Buat Password</h3>
            <form action="{{ route('register.savePassword') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Lanjut</button>
            </form>
        </div>
    </div>
</div>
@endsection
