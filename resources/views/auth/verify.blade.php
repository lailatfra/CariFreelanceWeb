@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success" role="alert">
                    Link verifikasi baru telah dikirim ke email kamu.
                </div>
            @endif

            <div class="card">
                <div class="card-header">Verifikasi Email</div>

                <div class="card-body">
                    <p>Sebelum lanjut, silakan cek email dan klik link verifikasi yang sudah dikirim.</p>
                    <p>Jika belum menerima email, klik tombol di bawah untuk kirim ulang.</p>

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
