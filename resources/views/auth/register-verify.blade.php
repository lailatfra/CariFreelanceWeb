<form method="POST" action="{{ route('register.verify') }}">
    @csrf
    <input type="text" name="code" placeholder="Kode Verifikasi">
    <button type="submit">Verifikasi</button>
</form>
