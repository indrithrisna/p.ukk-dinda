<?php
session_start();
include "../config/koneksi.php";

if(isset($_POST['login'])){
  $u = $_POST['username'];
  $p = md5($_POST['password']);

  $q = mysqli_query($conn,"SELECT * FROM users WHERE username='$u' AND password='$p'");
  $data = mysqli_fetch_assoc($q);

  if($data){
    $_SESSION['login'] = true;
    $_SESSION['role'] = $data['role'];
    header("Location: dashboard.php");
  } else {
    echo "Login gagal";
  }
}
?>

<form method="post">
  <h2>Login Rental Mobil</h2>
  <input type="text" name="username" placeholder="Username"><br>
  <input type="password" name="password" placeholder="Password"><br>
  <button name="login">Login</button>
</form>