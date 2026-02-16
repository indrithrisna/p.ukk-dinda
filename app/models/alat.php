<?php
class Alat {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getAll(){
        return mysqli_query($this->db->conn,"SELECT * FROM alat");
    }

    public function getById($id){
        $id = mysqli_real_escape_string($this->db->conn, $id);
        $q = mysqli_query($this->db->conn,"SELECT * FROM alat WHERE id='$id'");
        return mysqli_fetch_assoc($q);
    }

    public function tambah($data){
        $nama = mysqli_real_escape_string($this->db->conn, $data['nama_alat']);
        $stok = mysqli_real_escape_string($this->db->conn, $data['stok']);
        $harga = mysqli_real_escape_string($this->db->conn, $data['harga']);
        $status = mysqli_real_escape_string($this->db->conn, $data['status']);

        $q = "INSERT INTO alat (nama_alat, stok, harga, status) 
              VALUES ('$nama', '$stok', '$harga', '$status')";
        
        return mysqli_query($this->db->conn, $q);
    }

    public function edit($data){
        $id = mysqli_real_escape_string($this->db->conn, $data['id']);
        $nama = mysqli_real_escape_string($this->db->conn, $data['nama_alat']);
        $stok = mysqli_real_escape_string($this->db->conn, $data['stok']);
        $harga = mysqli_real_escape_string($this->db->conn, $data['harga']);
        $status = mysqli_real_escape_string($this->db->conn, $data['status']);

        $q = "UPDATE alat SET 
              nama_alat='$nama', 
              stok='$stok', 
              harga='$harga', 
              status='$status' 
              WHERE id='$id'";
        
        return mysqli_query($this->db->conn, $q);
    }

    public function hapus($id){
        $id = mysqli_real_escape_string($this->db->conn, $id);
        return mysqli_query($this->db->conn, "DELETE FROM alat WHERE id='$id'");
    }
}