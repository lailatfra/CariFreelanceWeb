<form method="POST" action="{{ route('client.profile.store') }}">
    @csrf
    <input type="text" name="company_name" placeholder="Nama Perusahaan">
    <input type="text" name="address" placeholder="Alamat">
    <button type="submit">Simpan</button>
</form>
