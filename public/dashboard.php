<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
?>

<h1>Dashboard</h1>
Role: <?= $_SESSION['role'] ?>

<ul>
  <li><a href="mobil.php">Data Mobil</a></li>
  <li><a href="pinjam.php">Peminjaman</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>