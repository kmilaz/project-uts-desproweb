<?php
include __DIR__ . '/../database/migrasi.php';

// Check if customer is logged in
$customer_logged_in = isset($_SESSION['customer_logged_in']) && $_SESSION['customer_logged_in'] === true;
$customer_name = $customer_logged_in ? $_SESSION['customer_name'] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> - Dainty Doodles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">
    <style>
        .user-menu {
            position: relative;
            display: inline-block;
        }
        .user-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            min-width: 200px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            padding: 10px 0;
            z-index: 1000;
            margin-top: 5px;
        }
        .user-dropdown a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
        }
        .user-dropdown a:hover {
            background: #f5f5f5;
        }
        .user-menu:hover .user-dropdown {
            display: block;
        }
        .user-name {
            font-size: 0.85em;
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>
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
            <?php if ($customer_logged_in): ?>
                <div class="user-menu">
                    <a href="#" title="<?php echo htmlspecialchars($customer_name); ?>">
                        <i class="fa-solid fa-user"></i>
                        <span class="user-name"><?php echo htmlspecialchars(explode(' ', $customer_name)[0]); ?></span>
                    </a>
                    <div class="user-dropdown">
                        <a href="#">My Account</a>
                        <a href="/auth/customer_logout.php">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="/auth/views/login.php" title="Login / Register">
                    <i class="fa-regular fa-user"></i>
                </a>
            <?php endif; ?>
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