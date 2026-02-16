<?php require_once __DIR__ . '/../header.php'; ?>

<h2>Dashboard Peminjam</h2>
<p>Selamat datang, <strong><?= $_SESSION['username'] ?? 'User' ?></strong>! Anda login sebagai <strong>Peminjam</strong></p>

<div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin: 20px 0;">
    <div class="stat-card">
        <h3 style="margin: 0; font-size: 36px;"><?= $data['total_mobil'] ?></h3>
        <p style="margin: 5px 0 0 0;">Mobil Tersedia</p>
    </div>
    <div class="stat-card">
        <h3 style="margin: 0; font-size: 36px;"><?= $data['peminjaman_aktif'] ?></h3>
        <p style="margin: 5px 0 0 0;">Peminjaman Aktif</p>
    </div>
</div>

<h3>Hak Akses Peminjam:</h3>
<ul style="background: white; padding: 20px; border-radius: 8px;">
    <li>✅ Lihat daftar mobil tersedia</li>
    <li>✅ Ajukan peminjaman mobil</li>
    <li>✅ Lihat riwayat peminjaman sendiri</li>
    <li>❌ Tidak bisa edit/hapus data mobil</li>
    <li>❌ Tidak bisa lihat peminjaman user lain</li>
</ul>

<h3>Mobil Tersedia:</h3>
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
<?php 
$alat = new Alat;
$mobil = $alat->getAll();
while($m = mysqli_fetch_assoc($mobil)): 
?>
    <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <h4 style="margin: 0 0 10px 0;"><?= $m['nama_alat'] ?></h4>
        <p style="margin: 5px 0;"><strong>Plat:</strong> <?= $m['plat_nomor'] ?? '-' ?></p>
        <p style="margin: 5px 0;">Harga: Rp <?= number_format($m['harga'], 0, ',', '.') ?>/hari</p>
        <p style="margin: 5px 0;">Status: <strong><?= ucfirst($m['status']) ?></strong></p>
        <?php if($m['status'] == 'tersedia'): ?>
            <a href="<?= BASEURL ?>/index.php?url=peminjaman/tambah&id_mobil=<?= $m['id'] ?>" class="btn" style="margin-top: 10px;">Sewa Sekarang</a>
        <?php else: ?>
            <button class="btn" disabled style="margin-top: 10px; opacity: 0.5;">Tidak Tersedia</button>
        <?php endif; ?>
    </div>
<?php endwhile; ?>
</div>

<?php require_once __DIR__ . '/../footer.php'; ?>
