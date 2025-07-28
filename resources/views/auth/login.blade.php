@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Login</h2>

    {{-- Login Manual --}}
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email dan Password Input -->
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <hr>

    {{-- Login Dengan Google --}}
    <a href="{{ route('google.redirect') }}" class="btn btn-danger">
        <i class="fab fa-google"></i> Login dengan Google
    </a>
</div>
@endsection
