<?php
include "../config/koneksi.php";

if(isset($_POST['simpan'])){
  mysqli_query($conn,"INSERT INTO mobil VALUES(
    null,
    '$_POST[nama]',
    '$_POST[plat]',
    '$_POST[harga]',
    'tersedia'
  )");
}
$data = mysqli_query($conn,"SELECT * FROM mobil");
?>

<h2>Data Mobil</h2>
<form method="post">
  <input name="nama" placeholder="Nama Mobil">
  <input name="plat" placeholder="Plat">
  <input name="harga" placeholder="Harga">
  <button name="simpan">Tambah</button>
</form>

<table border="1">
<tr><th>Nama</th><th>Plat</th><th>Harga</th><th>Status</th></tr>
<?php while($m=mysqli_fetch_assoc($data)){ ?>
<tr>
  <td><?= $m['nama_mobil'] ?></td>
  <td><?= $m['plat'] ?></td>
  <td><?= $m['harga'] ?></td>
  <td><?= $m['status'] ?></td>
</tr>
<?php } ?>
</table>