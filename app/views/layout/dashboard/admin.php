<?php require_once __DIR__ . '/../header.php'; ?>

<h2>Dashboard Admin</h2>
<p>Selamat datang, <strong><?= $_SESSION['username'] ?? 'Admin' ?></strong>! Anda login sebagai <strong>Admin</strong></p>

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin: 20px 0;">
    <div class="stat-card">
        <h3 style="margin: 0; font-size: 36px;"><?= $data['total_mobil'] ?></h3>
        <p style="margin: 5px 0 0 0;">Total Mobil</p>
    </div>
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

<h3>Tugas Admin:</h3>
<ul style="background: white; padding: 20px; border-radius: 8px;">
    <li>✅ Kelola semua data mobil (tambah, edit, hapus)</li>
    <li>✅ Kelola semua data peminjaman</li>
    <li>✅ Lihat laporan lengkap</li>
    <li>✅ Kelola user petugas dan peminjam</li>
    <li>✅ Approve/reject peminjaman</li>
</ul>

<h3>Peminjaman Terbaru:</h3>
<table>
<tr>
    <th>Nama Peminjam</th>
    <th>Mobil</th>
    <th>Tanggal Pinjam</th>
    <th>Status</th>
    <th>Total</th>
</tr>
<?php while($p = mysqli_fetch_assoc($data['recent_peminjaman'])): ?>
<tr>
    <td><?= $p['nama_peminjam'] ?></td>
    <td><?= $p['nama_alat'] ?></td>
    <td><?= date('d/m/Y', strtotime($p['tanggal_pinjam'])) ?></td>
    <td><?= ucfirst($p['status']) ?></td>
    <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
</tr>
<?php endwhile; ?>
</table>

<?php require_once __DIR__ . '/../footer.php'; ?>
