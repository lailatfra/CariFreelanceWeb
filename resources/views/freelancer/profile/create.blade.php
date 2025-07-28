@extends('layouts.app')

@section('content')
<div class="container pt-5" style="padding-top: 100px;">
    <form method="POST" action="{{ route('freelancer.profile.store') }}" class="container mt-4">
        @csrf

        <div class="mb-3">
            <label for="skills" class="form-label">Keahlian</label>
            <input type="text" name="skills" id="skills" class="form-control" placeholder="Contoh: Desain Grafis, Web Development" required>
        </div>

        <div class="mb-3">
            <label for="experience_years" class="form-label">Tahun Pengalaman</label>
            <input type="number" name="experience_years" id="experience_years" class="form-control" placeholder="Contoh: 2">
        </div>

        <div class="mb-3">
            <label for="portofolio_link" class="form-label">Link Portofolio</label>
            <input type="url" name="portofolio_link" id="portofolio_link" class="form-control" placeholder="https://portfolio.com/nama">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Nomor HP</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="08xxxxxxxxxx">
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea name="bio" id="bio" class="form-control" rows="4" placeholder="Ceritakan sedikit tentang pengalaman atau spesialisasi Anda..."></textarea>
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
