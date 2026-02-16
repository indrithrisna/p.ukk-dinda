<?php require_once __DIR__ . '/../../header.php'; ?>

<h2>Edit Mobil</h2>
<form method="post" class="form-card">
    <input type="hidden" name="id" value="<?= $data['alat']['id'] ?>">
    
    <label>Nama Mobil:</label>
    <input type="text" name="nama_alat" value="<?= $data['alat']['nama_alat'] ?>" required>
    
    <label>Stok:</label>
    <input type="number" name="stok" value="<?= $data['alat']['stok'] ?? 0 ?>" required>
    
    <label>Harga/Hari:</label>
    <input type="number" name="harga" value="<?= $data['alat']['harga'] ?>" required>
    
    <label>Status:</label>
    <select name="status" required>
        <option value="tersedia" <?= $data['alat']['status'] == 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
        <option value="disewa" <?= $data['alat']['status'] == 'disewa' ? 'selected' : '' ?>>Disewa</option>
        <option value="maintenance" <?= $data['alat']['status'] == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
    </select>
    
    <div class="form-actions">
        <button type="submit" class="btn">Update</button>
        <a href="<?= BASEURL ?>/index.php?url=alat" class="btn-cancel">Batal</a>
    </div>
</form>

<?php require_once __DIR__ . '/../../footer.php'; ?>