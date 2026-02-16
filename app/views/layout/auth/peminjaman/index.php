<?php require_once __DIR__ . '/../../header.php'; ?>

<h2>Data Peminjaman</h2>

<?php if(isset($_GET['msg']) && $_GET['msg'] == 'pending'): ?>
<div class="alert-info" style="margin-bottom: 20px;">
    <strong>✅ Berhasil!</strong> Pengajuan peminjaman telah dikirim. Menunggu persetujuan petugas.
</div>
<?php endif; ?>

<?php 
$role = $_SESSION['role'] ?? 'peminjam';
if($role == 'peminjam'): 
?>
<a href="<?= BASEURL ?>/index.php?url=peminjaman/tambah" class="btn">+ Ajukan Peminjaman</a>
<?php else: ?>
<a href="<?= BASEURL ?>/index.php?url=peminjaman/tambah" class="btn">+ Tambah Peminjaman</a>
<?php endif; ?>

<br><br>
<table>
<tr>
<th>No</th>
<th>Nama Peminjam</th>
<th>No HP</th>
<th>No KTP</th>
<th>Mobil</th>
<th>Tanggal Pinjam</th>
<th>Tanggal Kembali</th>
<th>Lama Sewa</th>
<th>Total Harga</th>
<th>Status</th>
<th>Aksi</th>
</tr>
<?php 
$no=1; 
if(mysqli_num_rows($data['peminjaman']) == 0): 
?>
<tr>
    <td colspan="11" style="text-align: center;">Belum ada data peminjaman</td>
</tr>
<?php else: ?>
<?php foreach($data['peminjaman'] as $p): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $p['nama_peminjam'] ?></td>
<td><?= $p['no_hp'] ?></td>
<td><?= $p['no_ktp'] ?? '-' ?></td>
<td><?= $p['nama_alat'] ?></td>
<td><?= date('d/m/Y', strtotime($p['tanggal_pinjam'])) ?></td>
<td><?= date('d/m/Y', strtotime($p['tanggal_kembali'])) ?></td>
<td><?= $p['lama_sewa'] ?> hari</td>
<td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
<td>
    <?php if($p['status'] == 'pending'): ?>
        <span style="color: #ff9800; font-weight: bold;">⏳ Menunggu Approval</span>
    <?php elseif($p['status'] == 'ditolak'): ?>
        <span style="color: #f44336; font-weight: bold;">❌ Ditolak</span>
    <?php elseif($p['status'] == 'dipinjam'): ?>
        <span style="color: #2196f3; font-weight: bold;">🚗 Dipinjam</span>
    <?php elseif($p['status'] == 'menunggu validasi'): ?>
        <span style="color: #9c27b0; font-weight: bold;">⏳ Menunggu Validasi</span>
    <?php elseif($p['status'] == 'dikembalikan'): ?>
        <span style="color: #4caf50; font-weight: bold;">✅ Dikembalikan</span>
    <?php else: ?>
        <span style="color: #f44336; font-weight: bold;">⚠️ Terlambat</span>
    <?php endif; ?>
</td>
<td>
    <?php 
    // Petugas/Admin bisa approve peminjaman pending
    if(($role == 'petugas' || $role == 'admin') && $p['status'] == 'pending'): 
    ?>
        <a href="<?= BASEURL ?>/index.php?url=peminjaman/approve&id=<?= $p['id'] ?>" class="btn-edit">Approve</a>
    <?php endif; ?>
    
    <?php 
    // Peminjam hanya bisa ajukan pengembalian jika status dipinjam
    if($role == 'peminjam' && $p['status'] == 'dipinjam'): 
    ?>
        <a href="<?= BASEURL ?>/index.php?url=peminjaman/kembali&id=<?= $p['id'] ?>" class="btn-edit" onclick="return confirm('Ajukan pengembalian mobil?\nMobil akan dicek oleh petugas.')">Ajukan Pengembalian</a>
    <?php endif; ?>
    
    <?php 
    // Petugas/Admin bisa validasi pengembalian
    if(($role == 'petugas' || $role == 'admin') && $p['status'] == 'menunggu validasi'): 
    ?>
        <a href="<?= BASEURL ?>/index.php?url=peminjaman/kembali&id=<?= $p['id'] ?>" class="btn-edit">Validasi</a>
    <?php endif; ?>
    
    <?php 
    // Admin bisa hapus
    if($role == 'admin'): 
    ?>
    <a href="<?= BASEURL ?>/index.php?url=peminjaman/hapus&id=<?= $p['id'] ?>" class="btn-delete" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
    <?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
<?php endif; ?>
</table>

<?php require_once __DIR__ . '/../../footer.php'; ?>
