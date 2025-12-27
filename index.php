<?php
session_start();
require_once "classes/Cart.php";
$cart = new Cart();
$totalItems = $cart->getTotalItems();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AMD</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<header class="navbar">
    <div class="logo">AMD</div>
    <ul>
        <li><a href="views/products.php">Products</a></li>
        <li>Solutions</li>
        <li>Resources & Support</li>
        <?php if (isset($_SESSION['level']) && $_SESSION['level'] == 0): ?>
            <li><a href="views/admin/dashboard.php" style="color: #ff0000; font-weight: bold;">
                <i class="fa-solid fa-user-shield"></i> Admin Panel
            </a></li>
        <?php endif; ?>
    </ul>
    <div class="icons">
    <?php if (isset($_SESSION['username'])): ?>
        <span class="user-name"><?php echo $_SESSION['username']; ?></span>
        <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
    <?php else: ?>
        <a href="auth/login.php"><i class="fa-solid fa-user"></i></a>
    <?php endif; ?>
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

<section class="hero">
    <h1>Your Trusted Partner for Advancing AI</h1>

    <div class="hero-card">
        <div class="hero-text">
            <h2>Advancing Enterprise AI</h2>
            <p>
                Accelerate AI breakthroughs with end-to-end computing
                solutions and broad technology partnerships.
            </p>
            <button>Learn More</button>
        </div>

        <div class="hero-image">
            <div class="amd-shape"></div>
        </div>
    </div>
</section>

<section class="why-amd">
    <h2>Why AMD</h2>

    <div class="why-grid">
        <div class="why-item">
            <h3>Broadest Portfolio of AI Solutions</h3>
            <p>
                AMD is the only AI partner offering CPU, GPU, and adaptive
                computing solutions, enabling optimized AI deployments.
            </p>
        </div>

        <div class="why-item">
            <h3>Open Ecosystem Approach</h3>
            <p>
                A commitment to open standards and co-innovation fosters
                flexibility and confidence to deploy AI end-to-end.
            </p>
        </div>

        <div class="why-item">
            <h3>Proven Leadership in Innovation</h3>
            <p>
                AMD delivers industry-leading performance, reliability,
                and scalability across data center and edge.
            </p>
        </div>
    </div>

    <div class="why-btn">
        <button>Explore AI Solutions →</button>
    </div>
</section>

<footer class="footer">
    <div class="footer-top">
        <button class="subscribe-btn">
            Subscribe to the latest news from AMD
        </button>

        <div class="social-icons">
            <span>in</span><span>X</span><span>📷</span>
            <span>▶</span><span>f</span><span>🎮</span><span>✉</span>
        </div>
    </div>

    <div class="footer-links">
        <div>
            <h4>Company</h4>
            <a>About AMD</a>
            <a>Management Team</a>
            <a>Corporate Responsibility</a>
            <a>Careers</a>
            <a>Contact Us</a>
        </div>

        <div>
            <h4>News & Events</h4>
            <a>Newsroom</a>
            <a>Events</a>
            <a>Media Library</a>
        </div>

        <div>
            <h4>Resources</h4>
            <a>Developer Central</a>
            <a>Blogs</a>
            <a>Case Studies</a>
            <a>Webinars</a>
            <a>Explore Resources</a>
        </div>

        <div>
            <h4>Partners</h4>
            <a>AMD Partner Hub</a>
            <a>Authorized Distributors</a>
            <a>AMD University Program</a>
        </div>

        <div>
            <h4>Investors</h4>
            <a>Investor Relations</a>
            <a>Financial Information</a>
            <a>Board of Directors</a>
            <a>Governance Documents</a>
            <a>SEC Filings</a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>
            Terms and Conditions | Privacy | Trademarks |
            Supply Chain Transparency | Cookies Policy | Cookie Settings
        </p>
        <p class="copyright">
            © 2025 Advanced Micro Devices, Inc.
        </p>
    </div>
</footer>

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

<script src="assets/js/cart.js"></script>

</body>
</html>