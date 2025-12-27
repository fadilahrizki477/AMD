<?php
require_once __DIR__ . "/../config/Database.php";

class User extends Database {

    public function login($username, $password) {
        // Escape input untuk mencegah SQL injection
        $username = mysqli_real_escape_string($this->conn, $username);
        $password = md5($password);
        
        $query = mysqli_query($this->conn,
            "SELECT * FROM users 
             WHERE username='$username' AND password='$password'"
        );
        return mysqli_fetch_assoc($query);
    }

    public function register($username, $password) {
        // Escape input untuk mencegah SQL injection
        $username = mysqli_real_escape_string($this->conn, $username);
        $password = md5($password);
        $level = 1; // user biasa

        // cek username
        $cek = mysqli_query($this->conn,
            "SELECT * FROM users WHERE username='$username'"
        );

        if (mysqli_num_rows($cek) > 0) {
            return false;
        }

        mysqli_query($this->conn,
            "INSERT INTO users (username, password, level)
             VALUES ('$username', '$password', '$level')"
        );

        return true;
    }
}
?>