@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="alert alert-info text-center">
        <h4>Verifikasi Email Kamu</h4>
        <p>
            Kami telah mengirimkan link verifikasi ke alamat email kamu.<br>
            Silakan cek email dan klik link untuk melanjutkan.
        </p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary mt-3">Kirim Ulang Email Verifikasi</button>
        </form>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success text-center mt-3">
            Link verifikasi baru telah dikirim ke email kamu!
        </div>
    @endif
</div>
@endsection
