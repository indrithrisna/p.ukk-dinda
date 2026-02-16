<!DOCTYPE html>
<html>
<head>
<title>Login - Rental Mobil</title>
<link rel="stylesheet" href="<?= BASEURL ?>/style.css?v=3.0">
</head>
<body>
<div class="container">
<form action="<?= BASEURL ?>/index.php?url=login" method="post" class="card">
<h2>🚗 Login Rental Mobil</h2>
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>
</div>
</body>
</html>