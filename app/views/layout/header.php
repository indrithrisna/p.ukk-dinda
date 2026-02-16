<!DOCTYPE html>
<html>
<head>
<title>Rental Mobil</title>
<link rel="stylesheet" href="<?= BASEURL ?>/style.css?v=3.0">
</head>
<body>
<?php if(isset($_SESSION['login'])): ?>
<div class="navbar">
<span style="font-weight: bold;">🚗 Rental Mobil</span> | 
<a href="<?= BASEURL ?>/index.php?url=dashboard">Dashboard</a> |
<?php if(isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'petugas')): ?>
<a href="<?= BASEURL ?>/index.php?url=alat">Data Mobil</a> |
<a href="<?= BASEURL ?>/index.php?url=peminjaman">Data Peminjaman</a> |
<?php else: ?>
<a href="<?= BASEURL ?>/index.php?url=peminjaman/tambah">Sewa Mobil</a> |
<a href="<?= BASEURL ?>/index.php?url=peminjaman">Riwayat Saya</a> |
<?php endif; ?>
<span style="float: right;">
    👤 <?= $_SESSION['username'] ?? 'User' ?> (<?= ucfirst($_SESSION['role'] ?? 'peminjam') ?>) | 
    <a href="<?= BASEURL ?>/index.php?url=logout">Logout</a>
</span>
</div>
<?php endif; ?>
<div class="container">