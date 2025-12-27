<?php
session_start();
require_once "../classes/Cart.php";

$cart = new Cart();

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    
    switch ($action) {
        case 'add':
            $cart->addItem(
                $_POST['id'],
                $_POST['nama'],
                $_POST['harga'],
                isset($_POST['qty']) ? $_POST['qty'] : 1
            );
            echo json_encode([
                'success' => true,
                'message' => 'Produk ditambahkan ke keranjang',
                'total_items' => $cart->getTotalItems()
            ]);
            break;
            
        case 'update':
            $cart->updateQty($_POST['id'], $_POST['qty']);
            echo json_encode([
                'success' => true,
                'total_items' => $cart->getTotalItems(),
                'total_price' => $cart->getTotalPrice()
            ]);
            break;
            
        case 'remove':
            $cart->removeItem($_POST['id']);
            echo json_encode([
                'success' => true,
                'total_items' => $cart->getTotalItems(),
                'total_price' => $cart->getTotalPrice()
            ]);
            break;
            
        case 'clear':
            $cart->clear();
            echo json_encode([
                'success' => true,
                'message' => 'Keranjang dikosongkan'
            ]);
            break;
            
        case 'get':
            echo json_encode([
                'success' => true,
                'items' => $cart->getItems(),
                'total_items' => $cart->getTotalItems(),
                'total_price' => $cart->getTotalPrice()
            ]);
            break;
    }
}
?>