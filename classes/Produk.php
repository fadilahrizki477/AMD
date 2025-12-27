<?php
require_once __DIR__ . "/../config/Database.php";

class Produk extends Database {

    public function getAll() {
        return mysqli_query($this->conn, "SELECT * FROM products");
    }

    public function getById($id) {
        return mysqli_query($this->conn,
            "SELECT * FROM products WHERE id='$id'"
        );
    }

    public function tambah($nama, $harga) {
        return mysqli_query($this->conn,
            "INSERT INTO products (nama_produk, harga)
             VALUES ('$nama', '$harga')"
        );
    }

    public function update($id, $nama, $harga) {
        return mysqli_query($this->conn,
            "UPDATE products
             SET nama_produk='$nama', harga='$harga'
             WHERE id='$id'"
        );
    }

    public function hapus($id) {
        return mysqli_query($this->conn,
            "DELETE FROM products WHERE id='$id'"
        );
    }
}
