<?php
class PeminjamanController {
    public function index(){
        session_start();
        if(!isset($_SESSION['login'])){
            header("Location: ".BASEURL);
            exit;
        }

        $peminjaman = new Peminjaman;
        $data['peminjaman'] = $peminjaman->getAll();
        require_once __DIR__ . '/../views/layout/auth/peminjaman/index.php';
    }

    public function tambah(){
        session_start();
        if(!isset($_SESSION['login'])){
            header("Location: ".BASEURL);
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $peminjaman = new Peminjaman;
            if($peminjaman->tambah($_POST)){
                // Redirect dengan pesan sukses
                header("Location: ".BASEURL."/index.php?url=peminjaman&msg=pending");
                exit;
            }
        }

        // Get data alat untuk dropdown
        $alat = new Alat;
        $data['alat'] = $alat->getAll();
        $data['id_user'] = $_SESSION['user_id'] ?? 1;
        
        // Get ID mobil dari URL kalau ada
        $data['id_mobil_selected'] = $_GET['id_mobil'] ?? null;
        
        // Kalau ada ID mobil, get detail mobil
        if($data['id_mobil_selected']){
            $data['mobil_selected'] = $alat->getById($data['id_mobil_selected']);
        }
        
        require_once __DIR__ . '/../views/layout/auth/peminjaman/tambah.php';
    }
    
    public function approve(){
        session_start();
        if(!isset($_SESSION['login'])){
            header("Location: ".BASEURL);
            exit;
        }

        $role = $_SESSION['role'] ?? 'peminjam';
        
        // Hanya petugas/admin yang bisa approve
        if($role != 'petugas' && $role != 'admin'){
            header("Location: ".BASEURL."/index.php?url=peminjaman");
            exit;
        }
        
        // Proses approval
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $peminjaman = new Peminjaman;
            $peminjaman->approvePeminjaman($_POST);
            header("Location: ".BASEURL."/index.php?url=peminjaman");
            exit;
        }
        
        // Tampilkan form approval
        $peminjaman = new Peminjaman;
        $data['peminjaman'] = $peminjaman->getById($_GET['id']);
        require_once __DIR__ . '/../views/layout/auth/peminjaman/approve.php';
    }

    public function kembali(){
        session_start();
        if(!isset($_SESSION['login'])){
            header("Location: ".BASEURL);
            exit;
        }

        $role = $_SESSION['role'] ?? 'peminjam';
        
        // Peminjam hanya bisa ajukan pengembalian
        if($role == 'peminjam'){
            $peminjaman = new Peminjaman;
            $peminjaman->ajukanPengembalian($_GET['id']);
            header("Location: ".BASEURL."/index.php?url=peminjaman");
            exit;
        }
        
        // Petugas/Admin bisa validasi pengembalian
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $peminjaman = new Peminjaman;
            $peminjaman->validasiPengembalian($_POST);
            header("Location: ".BASEURL."/index.php?url=peminjaman");
            exit;
        }
        
        // Tampilkan form validasi
        $peminjaman = new Peminjaman;
        $data['peminjaman'] = $peminjaman->getById($_GET['id']);
        require_once __DIR__ . '/../views/layout/auth/peminjaman/validasi.php';
    }

    public function hapus(){
        session_start();
        if(!isset($_SESSION['login'])){
            header("Location: ".BASEURL);
            exit;
        }

        $peminjaman = new Peminjaman;
        $peminjaman->hapus($_GET['id']);
        header("Location: ".BASEURL."/index.php?url=peminjaman");
        exit;
    }
}
