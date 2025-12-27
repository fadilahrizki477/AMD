<?php
class Cart {
    
    public function __construct() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }
    
    // Tambah item ke cart
    public function addItem($id, $nama, $harga, $qty = 1) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$id] = [
                'id' => $id,
                'nama' => $nama,
                'harga' => $harga,
                'qty' => $qty
            ];
        }
    }
    
    // Update quantity
    public function updateQty($id, $qty) {
        if (isset($_SESSION['cart'][$id])) {
            if ($qty <= 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                $_SESSION['cart'][$id]['qty'] = $qty;
            }
        }
    }
    
    // Hapus item
    public function removeItem($id) {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
    }
    
    // Get semua item
    public function getItems() {
        return $_SESSION['cart'];
    }
    
    // Hitung total item
    public function getTotalItems() {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['qty'];
        }
        return $total;
    }
    
    // Hitung total harga
    public function getTotalPrice() {
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['harga'] * $item['qty'];
        }
        return $total;
    }
    
    // Clear cart
    public function clear() {
        $_SESSION['cart'] = [];
    }
}
?>