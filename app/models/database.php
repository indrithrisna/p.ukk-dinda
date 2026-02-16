<?php
class Database {
    public $conn;

    public function __construct(){
        $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if(!$this->conn){
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }
}