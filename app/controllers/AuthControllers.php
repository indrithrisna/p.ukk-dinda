<?php
class AuthController {
    public function login(){
        require_once __DIR__ . '/../views/layout/auth/login.php';
    }

    public function proses(){
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            header("Location: ".BASEURL);
            exit;
        }

        $user = new User;
        $data = $user->login($_POST['username'],$_POST['password']);

        if($data){
            // Hapus session lama dulu
            session_start();
            session_destroy();
            
            // Buat session baru
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];
            $_SESSION['user_id'] = $data['id'] ?? 1;
            
            header("Location: ".BASEURL."/index.php?url=dashboard");
            exit;
        } else {
            echo "<div style='padding: 20px; max-width: 600px; margin: 50px auto; background: white; border-radius: 8px;'>";
            echo "<h3>Login Gagal!</h3>";
            echo "<p>Username: <strong>" . htmlspecialchars($_POST['username']) . "</strong></p>";
            echo "<p>Password: <strong>" . htmlspecialchars($_POST['password']) . "</strong></p>";
            echo "<hr>";
            echo "<h4>User yang ada di database:</h4>";
            echo "<table border='1' cellpadding='5' style='width: 100%; border-collapse: collapse;'>";
            echo "<tr><th>Username</th><th>Role</th></tr>";
            $users = $user->getAllUsers();
            while($u = mysqli_fetch_assoc($users)){
                echo "<tr><td>" . $u['username'] . "</td><td>" . $u['role'] . "</td></tr>";
            }
            echo "</table>";
            echo "<hr>";
            echo "<p><strong>Pastikan username dan password persis sama (case sensitive)!</strong></p>";
            echo "<a href='".BASEURL."' style='display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; margin-top: 10px;'>Kembali ke Login</a>";
            echo "</div>";
        }
    }

    public function logout(){
        session_start();
        
        // Hapus semua session
        $_SESSION = array();
        
        // Hapus cookie session kalau ada
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-3600, '/');
        }
        
        // Destroy session
        session_destroy();
        
        // Redirect ke login
        header("Location: ".BASEURL);
        exit;
    }
}