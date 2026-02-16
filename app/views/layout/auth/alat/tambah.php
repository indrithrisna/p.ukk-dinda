<?php require_once __DIR__ . '/../../header.php'; ?>

<h2>Tambah Mobil</h2>
<form method="post" class="form-card">
    <label>Nama Mobil:</label>
    <input type="text" name="nama_alat" required>
    
    <label>Stok:</label>
    <input type="number" name="stok" required>
    
    <label>Harga/Hari:</label>
    <input type="number" name="harga" required>
    
    <label>Status:</label>
    <select name="status" required>
        <option value="tersedia">Tersedia</option>
        <option value="disewa">Disewa</option>
        <option value="maintenance">Maintenance</option>
    </select>
    
    <div class="form-actions">
        <button type="submit" class="btn">Simpan</button>
        <a href="<?= BASEURL ?>/index.php?url=alat" class="btn-cancel">Batal</a>
    </div>
</form>

<?php require_once __DIR__ . '/../../footer.php'; ?>