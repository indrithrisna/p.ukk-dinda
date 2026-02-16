<?php
class User {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function login($username,$password){
        $username = mysqli_real_escape_string($this->db->conn, $username);
        $password = mysqli_real_escape_string($this->db->conn, $password);
        
        $q = mysqli_query($this->db->conn,
            "SELECT * FROM user 
             WHERE username='$username' 
             AND password='$password'");
        
        if(!$q){
            die("Query error: " . mysqli_error($this->db->conn));
        }
        
        return mysqli_fetch_assoc($q);
    }
    
    public function getAllUsers(){
        return mysqli_query($this->db->conn, "SELECT username, role FROM user");
    }
}