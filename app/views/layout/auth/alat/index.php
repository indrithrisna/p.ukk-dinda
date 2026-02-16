<?php require_once __DIR__ . '/../../header.php'; ?>

<h2>Data Mobil</h2>
<?php 
$role = $_SESSION['role'] ?? 'peminjam';
if($role == 'admin'): 
?>
<a href="<?= BASEURL ?>/index.php?url=alat/tambah" class="btn">+ Tambah Mobil</a>
<?php endif; ?>
<br><br>
<table>
<tr>
<th>No</th>
<th>Nama Mobil</th>
<th>Plat Nomor</th>
<th>Harga/Hari</th>
<th>Status</th>
<?php if($role == 'admin'): ?>
<th>Aksi</th>
<?php endif; ?>
</tr>
<?php $no=1; foreach($data['alat'] as $a): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $a['nama_alat'] ?></td>
<td><strong><?= $a['plat_nomor'] ?? '-' ?></strong></td>
<td>Rp <?= number_format($a['harga'], 0, ',', '.') ?></td>
<td>
    <?php if($a['status'] == 'tersedia'): ?>
        <span style="color: #4caf50; font-weight: bold;">✅ Tersedia</span>
    <?php elseif($a['status'] == 'disewa'): ?>
        <span style="color: #ff9800; font-weight: bold;">🚗 Disewa</span>
    <?php else: ?>
        <span style="color: #f44336; font-weight: bold;">🔧 Maintenance</span>
    <?php endif; ?>
</td>
<?php if($role == 'admin'): ?>
<td>
<a href="<?= BASEURL ?>/index.php?url=alat/edit&id=<?= $a['id'] ?>" class="btn-edit">Edit</a>
<a href="<?= BASEURL ?>/index.php?url=alat/hapus&id=<?= $a['id'] ?>" class="btn-delete" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
</td>
<?php endif; ?>
</tr>
<?php endforeach; ?>
</table>

<?php require_once __DIR__ . '/../../footer.php'; ?>