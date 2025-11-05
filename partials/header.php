<?php
include 'database/migrasi.php';

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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="#" onclick="navigateTo('index.php')">
                <img src="assets/img/logo.png" alt="Dainty Doodles Logo">
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