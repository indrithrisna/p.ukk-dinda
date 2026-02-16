<?php
class Peminjaman {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getAll(){
        $q = "SELECT p.*, a.nama_alat 
              FROM peminjaman p
              LEFT JOIN alat a ON p.id_alat = a.id
              ORDER BY p.created_at DESC";
        return mysqli_query($this->db->conn, $q);
    }

    public function getByStatus($status){
        $status = mysqli_real_escape_string($this->db->conn, $status);
        $q = "SELECT p.*, a.nama_alat 
              FROM peminjaman p
              LEFT JOIN alat a ON p.id_alat = a.id
              WHERE p.status='$status'
              ORDER BY p.created_at DESC";
        return mysqli_query($this->db->conn, $q);
    }

    public function getRecent($limit = 5){
        $limit = (int)$limit;
        $q = "SELECT p.*, a.nama_alat 
              FROM peminjaman p
              LEFT JOIN alat a ON p.id_alat = a.id
              ORDER BY p.created_at DESC
              LIMIT $limit";
        return mysqli_query($this->db->conn, $q);
    }

    public function getById($id){
        $id = mysqli_real_escape_string($this->db->conn, $id);
        $q = "SELECT p.*, a.nama_alat 
              FROM peminjaman p
              LEFT JOIN alat a ON p.id_alat = a.id
              WHERE p.id='$id'";
        $result = mysqli_query($this->db->conn, $q);
        return mysqli_fetch_assoc($result);
    }

    public function tambah($data){
        $id_user = mysqli_real_escape_string($this->db->conn, $data['id_user']);
        $id_alat = mysqli_real_escape_string($this->db->conn, $data['id_alat']);
        $nama_peminjam = mysqli_real_escape_string($this->db->conn, $data['nama_peminjam']);
        $no_hp = mysqli_real_escape_string($this->db->conn, $data['no_hp']);
        $no_ktp = mysqli_real_escape_string($this->db->conn, $data['no_ktp']);
        $alamat = mysqli_real_escape_string($this->db->conn, $data['alamat']);
        $tanggal_pinjam = mysqli_real_escape_string($this->db->conn, $data['tanggal_pinjam']);
        $tanggal_kembali = mysqli_real_escape_string($this->db->conn, $data['tanggal_kembali']);
        $lama_sewa = mysqli_real_escape_string($this->db->conn, $data['lama_sewa']);
        $total_harga = mysqli_real_escape_string($this->db->conn, $data['total_harga']);

        // Status awal: pending (menunggu approval petugas)
        $q = "INSERT INTO peminjaman (id_user, id_alat, nama_peminjam, no_hp, no_ktp, alamat, tanggal_pinjam, tanggal_kembali, lama_sewa, total_harga, status) 
              VALUES ('$id_user', '$id_alat', '$nama_peminjam', '$no_hp', '$no_ktp', '$alamat', '$tanggal_pinjam', '$tanggal_kembali', '$lama_sewa', '$total_harga', 'pending')";
        
        return mysqli_query($this->db->conn, $q);
    }
    
    public function approvePeminjaman($data){
        $id = mysqli_real_escape_string($this->db->conn, $data['id']);
        $keputusan = mysqli_real_escape_string($this->db->conn, $data['keputusan']);
        $catatan = mysqli_real_escape_string($this->db->conn, $data['catatan_approval']);
        $petugas_id = mysqli_real_escape_string($this->db->conn, $data['petugas_id']);
        
        $status = ($keputusan == 'disetujui') ? 'dipinjam' : 'ditolak';
        
        $q = "UPDATE peminjaman SET 
              status='$status',
              catatan_petugas='$catatan',
              petugas_id='$petugas_id',
              tanggal_validasi=NOW()
              WHERE id='$id'";
        
        return mysqli_query($this->db->conn, $q);
    }

    public function updateStatus($id, $status){
        $id = mysqli_real_escape_string($this->db->conn, $id);
        $status = mysqli_real_escape_string($this->db->conn, $status);
        
        $q = "UPDATE peminjaman SET status='$status' WHERE id='$id'";
        return mysqli_query($this->db->conn, $q);
    }
    
    public function ajukanPengembalian($id){
        $id = mysqli_real_escape_string($this->db->conn, $id);
        
        $q = "UPDATE peminjaman SET 
              status='menunggu validasi' 
              WHERE id='$id'";
        return mysqli_query($this->db->conn, $q);
    }
    
    public function validasiPengembalian($data){
        $id = mysqli_real_escape_string($this->db->conn, $data['id']);
        $kondisi = mysqli_real_escape_string($this->db->conn, $data['kondisi_kembali']);
        $catatan = mysqli_real_escape_string($this->db->conn, $data['catatan_petugas']);
        $validasi = mysqli_real_escape_string($this->db->conn, $data['validasi_petugas']);
        
        $status = ($validasi == 'disetujui') ? 'dikembalikan' : 'dipinjam';
        
        $q = "UPDATE peminjaman SET 
              status='$status',
              kondisi_kembali='$kondisi',
              catatan_petugas='$catatan',
              validasi_petugas='$validasi',
              tanggal_validasi=NOW()
              WHERE id='$id'";
        
        return mysqli_query($this->db->conn, $q);
    }

    public function hapus($id){
        $id = mysqli_real_escape_string($this->db->conn, $id);
        return mysqli_query($this->db->conn, "DELETE FROM peminjaman WHERE id='$id'");
    }
}
