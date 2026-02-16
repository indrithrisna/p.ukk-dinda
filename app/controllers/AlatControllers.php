<?php
class AlatController {
    public function index(){
        session_start();
        if(!isset($_SESSION['login'])){
            header("Location: ".BASEURL);
            exit;
        }

        // Cek role - hanya admin dan petugas yang bisa akses
        $role = $_SESSION['role'] ?? 'peminjam';
        if($role != 'admin' && $role != 'petugas'){
            header("Location: ".BASEURL."/index.php?url=dashboard");
            exit;
        }

        $alat = new Alat;
        $data['alat'] = $alat->getAll();
        require_once __DIR__ . '/../views/layout/auth/alat/index.php';
    }

    public function tambah(){
        session_start();
        if(!isset($_SESSION['login'])){
            header("Location: ".BASEURL);
            exit;
        }

        // Cek role - hanya admin yang bisa tambah
        $role = $_SESSION['role'] ?? 'peminjam';
        if($role != 'admin'){
            header("Location: ".BASEURL."/index.php?url=alat");
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $alat = new Alat;
            if($alat->tambah($_POST)){
                header("Location: ".BASEURL."/index.php?url=alat");
                exit;
            }
        }

        require_once __DIR__ . '/../views/layout/auth/alat/tambah.php';
    }

    public function edit(){
        session_start();
        if(!isset($_SESSION['login'])){
            header("Location: ".BASEURL);
            exit;
        }

        // Cek role - hanya admin yang bisa edit
        $role = $_SESSION['role'] ?? 'peminjam';
        if($role != 'admin'){
            header("Location: ".BASEURL."/index.php?url=alat");
            exit;
        }

        $alat = new Alat;

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($alat->edit($_POST)){
                header("Location: ".BASEURL."/index.php?url=alat");
                exit;
            }
        }

        $data['alat'] = $alat->getById($_GET['id']);
        require_once __DIR__ . '/../views/layout/auth/alat/edit.php';
    }

    public function hapus(){
        session_start();
        if(!isset($_SESSION['login'])){
            header("Location: ".BASEURL);
            exit;
        }

        // Cek role - hanya admin yang bisa hapus
        $role = $_SESSION['role'] ?? 'peminjam';
        if($role != 'admin'){
            header("Location: ".BASEURL."/index.php?url=alat");
            exit;
        }

        $alat = new Alat;
        $alat->hapus($_GET['id']);
        header("Location: ".BASEURL."/index.php?url=alat");
        exit;
    }
}