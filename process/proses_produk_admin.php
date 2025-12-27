<?php
session_start();
require_once "../classes/Produk.php";

if (!isset($_SESSION['level']) || $_SESSION['level'] != 0) {
    header("Location: ../views/products.php");
    exit;
}

$produk = new Produk();

if ($_POST['aksi'] == "tambah") {
    $produk->tambah($_POST['nama'], $_POST['harga']);
}
elseif ($_POST['aksi'] == "edit") {
    $produk->update($_POST['id'], $_POST['nama'], $_POST['harga']);
}

// Redirect ke admin products page
header("Location: ../views/admin/products.php");
exit;
?>