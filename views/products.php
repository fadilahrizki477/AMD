<?php
session_start();

// 🔒 CEK LOGIN
if (!isset($_SESSION['username'])) {
    $_SESSION['redirect_after_login'] = "views/products.php";
    header("Location: ../auth/login.php");
    exit;
}

require_once "../classes/Produk.php";
require_once "../classes/Cart.php";

$produk = new Produk();
$data = $produk->getAll();

$cart = new Cart();
$totalItems = $cart->getTotalItems();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="../assets/css/products.css">
    <link rel="stylesheet" href="../assets/css/cart.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body style="background: #0a0a0a; padding: 0;">

<!-- Navbar -->
<header class="navbar">
    <div class="logo">AMD</div>
    <ul>
        <li><a href="products.php" style="color: #00c2ff;">Products</a></li>
        <li>Solutions</li>
        <li>Resources & Support</li>
        <li>Shop</li>
    </ul>
    <div class="icons">
        <span class="user-name"><?php echo $_SESSION['username']; ?></span>
        <a href="../logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        <span>🌐</span>
        <span>🔍</span>
        <span class="cart-icon" onclick="toggleCart()">
            <i class="fa-solid fa-cart-shopping"></i>
            <?php if ($totalItems > 0): ?>
                <span class="cart-badge"><?= $totalItems ?></span>
            <?php endif; ?>
        </span>
    </div>
</header>

<div style="padding: 40px;">

<h2>Daftar Produk</h2>

<div class="action-links">
    <a href="../index.php">← Kembali ke Home</a>
    <?php if ($_SESSION['level'] == 0): ?>
        <a href="produk_tambah.php" class="btn-add">+ Tambah Produk</a>
    <?php endif; ?>
</div>

<table>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Harga</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($row['nama_produk']) ?></td>
    <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>

    <td>
        <button class="btn-add-cart" onclick="addToCart(<?= $row['id'] ?>, '<?= htmlspecialchars($row['nama_produk']) ?>', <?= $row['harga'] ?>)">
            <i class="fa-solid fa-cart-plus"></i> Add to Cart
        </button>
        
        <?php if ($_SESSION['level'] == 0): ?>
        |
        <a href="produk_edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="produk_hapus.php?id=<?= $row['id'] ?>"
           onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
        <?php endif; ?>
    </td>
</tr>
<?php endwhile; ?>
</table>

</div>

<!-- Cart Overlay -->
<div class="cart-overlay" id="cartOverlay" onclick="toggleCart()"></div>

<!-- Shopping Cart Sidebar -->
<div class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
        <h2>Shopping Cart</h2>
        <button class="cart-close" onclick="toggleCart()">×</button>
    </div>
    
    <div class="cart-body" id="cartBody">
        <?php if (empty($cart->getItems())): ?>
            <div class="cart-empty">
                <div class="cart-empty-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <h3>Your cart is empty</h3>
                <p>Looks like you have no items in your shopping cart.</p>
            </div>
        <?php else: ?>
            <?php foreach ($cart->getItems() as $item): ?>
                <div class="cart-item" data-id="<?= $item['id'] ?>">
                    <div class="cart-item-info">
                        <div class="cart-item-name"><?= htmlspecialchars($item['nama']) ?></div>
                        <div class="cart-item-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></div>
                        <div class="cart-item-controls">
                            <button class="qty-btn" onclick="updateQty(<?= $item['id'] ?>, <?= $item['qty'] - 1 ?>)">-</button>
                            <span class="qty-display"><?= $item['qty'] ?></span>
                            <button class="qty-btn" onclick="updateQty(<?= $item['id'] ?>, <?= $item['qty'] + 1 ?>)">+</button>
                        </div>
                    </div>
                    <button class="cart-item-remove" onclick="removeItem(<?= $item['id'] ?>)">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <div class="cart-footer">
        <div class="cart-total">
            <span class="cart-total-label">Total:</span>
            <span class="cart-total-amount" id="cartTotal">
                Rp <?= number_format($cart->getTotalPrice(), 0, ',', '.') ?>
            </span>
        </div>
        <button class="cart-checkout-btn" onclick="checkout()">
            Proceed to Checkout
        </button>
    </div>
</div>

<script src="../assets/js/cart.js"></script>

</body>
</html>