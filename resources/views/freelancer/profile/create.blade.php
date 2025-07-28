<form method="POST" action="/freelancer/profile">
    @csrf
    <textarea name="skills" placeholder="Keahlian"></textarea>
    <input type="url" name="portfolio_url" placeholder="URL Portfolio (opsional)">
    <button type="submit">Simpan</button>
</form>
