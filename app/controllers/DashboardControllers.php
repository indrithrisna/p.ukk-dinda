<?php
class DashboardController {
    public function index(){
        session_start();
        if(!isset($_SESSION['login'])){
            header("Location: ".BASEURL);
            exit;
        }

        $role = $_SESSION['role'] ?? 'peminjam';
        
        // Get statistics
        $peminjaman = new Peminjaman;
        $alat = new Alat;
        
        $data['total_mobil'] = mysqli_num_rows($alat->getAll());
        $data['total_peminjaman'] = mysqli_num_rows($peminjaman->getAll());
        $data['peminjaman_aktif'] = mysqli_num_rows($peminjaman->getByStatus('dipinjam'));
        $data['peminjaman_selesai'] = mysqli_num_rows($peminjaman->getByStatus('dikembalikan'));
        
        // Get recent data
        $data['recent_peminjaman'] = $peminjaman->getRecent(5);
        
        if($role == 'admin'){
            require_once __DIR__ . '/../views/layout/dashboard/admin.php';
        } elseif($role == 'petugas'){
            require_once __DIR__ . '/../views/layout/dashboard/petugas.php';
        } else {
            require_once __DIR__ . '/../views/layout/dashboard/peminjam.php';
        }
    }
}
