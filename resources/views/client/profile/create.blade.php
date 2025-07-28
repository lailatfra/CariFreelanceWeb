@extends('layouts.app')

@section('content')
<div class="container pt-5" style="padding-top: 100px;">
    <form method="POST" action="{{ route('client.profile.store') }}" class="container mt-4">
        @csrf

        <div class="mb-5">
            <label for="company_name" class="form-label">Nama Perusahaan</label>
            <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Nama Perusahaan">
        </div>

        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="url" name="website" id="website" class="form-control" placeholder="https://example.com">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Nomor HP</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="08xxxxxxxxxx">
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea name="bio" id="bio" class="form-control" rows="4" placeholder="Tulis bio singkat tentang perusahaan Anda..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
