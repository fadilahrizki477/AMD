// Toggle Cart Sidebar
function toggleCart() {
    const sidebar = document.getElementById('cartSidebar');
    const overlay = document.getElementById('cartOverlay');
    
    if (sidebar && overlay) {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
    } else {
        console.error('Cart elements not found!');
    }
}

// Update Quantity
function updateQty(id, qty) {
    // Detect if we're in views folder or root
    const basePath = window.location.pathname.includes('/views/') ? '../process/' : 'process/';
    
    fetch(basePath + 'proses_cart.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `action=update&id=${id}&qty=${qty}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('❌ Gagal update quantity');
        }
    })
    .catch(err => {
        console.error('Error:', err);
        alert('❌ Gagal update quantity');
    });
}

// Remove Item
function removeItem(id) {
    if (confirm('Remove this item from cart?')) {
        // Detect if we're in views folder or root
        const basePath = window.location.pathname.includes('/views/') ? '../process/' : 'process/';
        
        fetch(basePath + 'proses_cart.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `action=remove&id=${id}`
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('❌ Gagal menghapus item');
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('❌ Gagal menghapus item');
        });
    }
}

// Add to Cart (untuk products page)
function addToCart(id, nama, harga) {
    fetch('../process/proses_cart.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `action=add&id=${id}&nama=${encodeURIComponent(nama)}&harga=${harga}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('✅ ' + data.message);
            location.reload();
        } else {
            alert('❌ Gagal menambahkan ke keranjang');
        }
    })
    .catch(err => {
        console.error('Error:', err);
        alert('❌ Gagal menambahkan ke keranjang');
    });
}

// Checkout
function checkout() {
    alert('Checkout feature coming soon!');
    // Future: redirect to checkout page
    // const basePath = window.location.pathname.includes('/views/') ? '../views/' : 'views/';
    // window.location.href = basePath + 'checkout.php';
}

// Debug function (optional)
function debugCart() {
    console.log('Cart Sidebar:', document.getElementById('cartSidebar'));
    console.log('Cart Overlay:', document.getElementById('cartOverlay'));
    console.log('Path:', window.location.pathname);
}