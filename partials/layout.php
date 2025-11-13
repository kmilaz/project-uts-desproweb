<?php
// Unified Layout Function
function renderLayout($pageTitle, $contentCallback, $isAdmin = false) {
    // Start output buffering to capture content
    ob_start();
    $contentCallback();
    $content = ob_get_clean();
    
    // Render the layout
    renderHeader($pageTitle, $isAdmin);
    echo $content;
    renderFooter($isAdmin);
}

function renderHeader($pageTitle, $isAdmin = false) {
    // Run migration if needed
    if (!$isAdmin) {
        include_once __DIR__ . '/../database/migrasi.php';
    }
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($pageTitle); ?> - Dainty Doodles</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="/assets/css/style.css">
        <?php if ($isAdmin): ?>
        <link rel="stylesheet" href="/assets/css/admin.css">
        <?php endif; ?>
        <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">
    </head>
    <body<?php echo $isAdmin ? ' class="admin-body"' : ''; ?>>
        <?php if (!$isAdmin): ?>
        <header class="header">
            <div class="logo">
                <a href="#" onclick="navigateTo('index.php')">
                    <img src="/assets/img/logo.png" alt="Dainty Doodles Logo">
                </a>
            </div>
            <nav class="navigasi">
                <a href="#" onclick="navigateTo('index.php')">Home</a>
                <a href="#" onclick="navigateTo('shop.php')">Shop</a>
                <a href="#" onclick="navigateTo('about.php')">About</a>
                <a href="#" onclick="navigateTo('kontak.php')">Contact</a>
            </nav>
            <div class="ikon-header">
                <a href="#"><i class="fa-regular fa-user"></i></a>
                <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                <a href="#"><i class="fa-regular fa-heart"></i></a>
                <a href="#" id="view-cart-btn">
                    <i class="fa-solid fa-cart-shopping"></i> (<span id="cart-count">0</span>)
                </a>
            </div>
        </header>
        <form action="keranjang.php" method="POST" id="cart-form" style="display:none;">
            <input type="hidden" name="cart_data" id="cart-data-input">
        </form>
        <form action="" method="POST" id="nav-form" style="display:none;">
            <input type="hidden" name="cart_data" id="nav-cart-data">
        </form>
        <?php else: ?>
        <header class="admin-header">
            <div class="admin-logo">
                <h2>Dainty Doodles Admin</h2>
            </div>
            <nav class="admin-nav">
                <a href="/produk/views/produkView.php">Products</a>
                <a href="/auth/logout.php" class="logout-btn">Logout</a>
            </nav>
        </header>
        <?php endif; ?>
    <?php
}

function renderFooter($isAdmin = false) {
    ?>
    <?php if (!$isAdmin): ?>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <h4>Dainty Doodles.</h4>
                <p>400 University Drive Suite 200 Coral Gables,<br>FL 33134 USA</p>
            </div>
            <div class="footer-col">
                <h4>Links</h4>
                <a href="index.php">Home</a>
                <a href="shop.php">Shop</a>
                <a href="#">About</a>
                <a href="kontak.php">Contact</a>
            </div>
            <div class="footer-col">
                <h4>Help</h4>
                <a href="#">Payment Options</a>
                <a href="#">Returns</a>
                <a href="#">Privacy Policies</a>
            </div>
            <div class="footer-col">
                <h4>Newsletter</h4>
                <form action="#" method="POST">
                    <input type="email" placeholder="Enter Your Email Address">
                    <button type="submit">SUBSCRIBE</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>2025 DaintyDoodles. All rights reserved</p>
        </div>
    </footer>
    <?php else: ?>
    <footer class="admin-footer">
        <p>&copy; 2025 Dainty Doodles Admin Panel</p>
    </footer>
    <?php endif; ?>

    <script>
        var initialCartData = <?php echo isset($GLOBALS['initial_cart_js']) ? $GLOBALS['initial_cart_js'] : '[]'; ?>;
    </script>

    <script src="/assets/jquery/jquery-3.7.1.js"></script>
    <script src="/assets/js/script.js"></script>
    </body>
    </html>
    <?php
}
?>
