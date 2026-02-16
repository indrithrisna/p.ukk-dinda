<?php
include "../config/koneksi.php";

if(isset($_POST['pinjam'])){
  mysqli_query($conn,"INSERT INTO peminjaman VALUES(
    null,
    '$_POST[id_mobil]',
    '$_POST[nama]',
    CURDATE(),
    '$_POST[tgl]',
    0,
    'pinjam'
  )");
  mysqli_query($conn,"UPDATE mobil SET status='dipinjam' WHERE id='$_POST[id_mobil]'");
}

$mobil = mysqli_query($conn,"SELECT * FROM mobil WHERE status='tersedia'");
$data = mysqli_query($conn,"SELECT * FROM peminjaman");
?>

<h2>Peminjaman</h2>

<form method="post">
  <select name="id_mobil">
    <?php while($m=mysqli_fetch_assoc($mobil)){ ?>
      <option value="<?= $m['id'] ?>"><?= $m['nama_mobil'] ?></option>
    <?php } ?>
  </select>
  <input name="nama" placeholder="Nama Penyewa">
  <input type="date" name="tgl">
  <button name="pinjam">Pinjam</button>
</form>

<table border="1">
<tr><th>Mobil</th><th>Penyewa</th><th>Status</th></tr>
<?php while($p=mysqli_fetch_assoc($data)){ ?>
<tr>
  <td><?= $p['id_mobil'] ?></td>
  <td><?= $p['nama_penyewa'] ?></td>
  <td><?= $p['status'] ?></td>
</tr>
<?php } ?>
</table>