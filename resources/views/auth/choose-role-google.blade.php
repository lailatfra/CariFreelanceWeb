@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-4" style="max-width: 600px;">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h3 class="mb-4 text-center">Daftar Sebagai</h3>

            <form method="POST" action="{{ route('register.step2.google.submit') }}">
                @csrf

                <div class="form-check mb-3 p-3 border rounded-3 d-flex align-items-center gap-3" style="cursor:pointer;">
                    <input class="form-check-input" type="radio" name="role" id="client" value="client" required>
                    <label class="form-check-label flex-grow-1" for="client">
                        <strong><i class="fas fa-user-tie me-2 text-primary"></i> Client</strong>
                        <div class="text-muted small">Saya ingin mencari freelancer untuk menyelesaikan proyek.</div>
                    </label>
                </div>

                <div class="form-check mb-4 p-3 border rounded-3 d-flex align-items-center gap-3" style="cursor:pointer;">
                    <input class="form-check-input" type="radio" name="role" id="freelancer" value="freelancer" required>
                    <label class="form-check-label flex-grow-1" for="freelancer">
                        <strong><i class="fas fa-laptop-code me-2 text-success"></i> Freelancer</strong>
                        <div class="text-muted small">Saya ingin menawarkan jasa dan bekerja pada proyek.</div>
                    </label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Lanjut</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
