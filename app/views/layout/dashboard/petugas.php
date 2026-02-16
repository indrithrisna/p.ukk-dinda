<?php require_once __DIR__ . '/../header.php'; ?>

<h2>Dashboard Petugas</h2>
<p>Selamat datang, <strong><?= $_SESSION['username'] ?? 'Petugas' ?></strong>! Anda login sebagai <strong>Petugas</strong></p>

<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin: 20px 0;">
    <div class="stat-card">
        <h3 style="margin: 0; font-size: 36px;"><?= $data['total_peminjaman'] ?></h3>
        <p style="margin: 5px 0 0 0;">Total Peminjaman</p>
    </div>
    <div class="stat-card">
        <h3 style="margin: 0; font-size: 36px;"><?= $data['peminjaman_aktif'] ?></h3>
        <p style="margin: 5px 0 0 0;">Sedang Dipinjam</p>
    </div>
    <div class="stat-card">
        <h3 style="margin: 0; font-size: 36px;"><?= $data['peminjaman_selesai'] ?></h3>
        <p style="margin: 5px 0 0 0;">Selesai</p>
    </div>
</div>

<h3>Tugas Petugas:</h3>
<ul style="background: white; padding: 20px; border-radius: 8px;">
    <li>✅ Input data peminjaman baru</li>
    <li>✅ Update status peminjaman (dikembalikan)</li>
    <li>✅ Lihat data mobil tersedia</li>
    <li>✅ Verifikasi pengembalian mobil</li>
    <li>❌ Tidak bisa hapus/edit data mobil</li>
</ul>

<h3>Peminjaman Aktif:</h3>
<table>
<tr>
    <th>Nama Peminjam</th>
    <th>Mobil</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Total</th>
    <th>Aksi</th>
</tr>
<?php 
$aktif = new Peminjaman;
$result = $aktif->getByStatus('dipinjam');
while($p = mysqli_fetch_assoc($result)): 
?>
<tr>
    <td><?= $p['nama_peminjam'] ?></td>
    <td><?= $p['nama_alat'] ?></td>
    <td><?= date('d/m/Y', strtotime($p['tanggal_pinjam'])) ?></td>
    <td><?= date('d/m/Y', strtotime($p['tanggal_kembali'])) ?></td>
    <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
    <td>
        <a href="<?= BASEURL ?>/index.php?url=peminjaman/kembali&id=<?= $p['id'] ?>" class="btn-edit" onclick="return confirm('Tandai sebagai dikembalikan?')">Kembalikan</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php require_once __DIR__ . '/../footer.php'; ?>
