<?php
require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/../model/produkModel.php';

// Product data for seeding
$products = [
    [
        "name" => "Pastel Beads",
        "price" => 12500,
        "image" => "assets/img/pastel-beads.png",
        "category" => "Beads",
        "tags" => "Pastel, Beads",
        "description" => "Lembut, ceria, dan lebih gemas! Koleksi manik-manik pastel hadir untuk kamu para craft-enthusiast."
    ],
    [
        "name" => "Lily",
        "price" => 15000,
        "image" => "assets/img/lily.png",
        "category" => "Beads",
        "tags" => "Flower, Beads",
        "description" => "Manik-manik berbentuk bunga lily yang lucu dan menggemaskan."
    ],
    [
        "name" => "Pearl Beads",
        "price" => 12500,
        "image" => "assets/img/pearls.png",
        "category" => "Beads",
        "tags" => "Pearl, Beads",
        "description" => "Manik-manik mutiara dengan warna-warni pastel yang cantik."
    ],
    [
        "name" => "Flower Beads",
        "price" => 17000,
        "image" => "assets/img/flower-beads.png",
        "category" => "Charms",
        "tags" => "Flower, Charm",
        "description" => "Charm berbentuk bunga untuk melengkapi kreasi Anda."
    ],
    [
        "name" => "Scallop Beads",
        "price" => 20000,
        "image" => "assets/img/scallop-beads.png",
        "category" => "Beads",
        "tags" => "Scallop, Sea",
        "description" => "Manik-manik berbentuk kerang yang indah."
    ],
    [
        "name" => "Pink Galaxy Beads",
        "price" => 17000,
        "image" => "assets/img/pink-galaxy.png",
        "category" => "Beads",
        "tags" => "Pink, Galaxy",
        "description" => "Manik-manik bulat dengan sentuhan galaksi berwarna pink."
    ],
    [
        "name" => "Respira",
        "price" => 25000,
        "image" => "assets/img/respira.png",
        "category" => "Pendant",
        "tags" => "Fruits, Pendant",
        "description" => "Pendant lucu berbentuk aneka buah-buahan."
    ],
    [
        "name" => "Bee Beads",
        "price" => 21500,
        "image" => "assets/img/bee-beads.png",
        "category" => "Beads",
        "tags" => "Bee, Animal",
        "description" => "Manik-manik berbentuk lebah yang sangat unik."
    ],
    [
        "name" => "Berry Beads",
        "price" => 20500,
        "image" => "assets/img/berry-beads.png",
        "category" => "Charms",
        "tags" => "Berry, Fruits",
        "description" => "Charm berbentuk buah berry yang segar."
    ]
];

// Check if products already exist to prevent duplicates
$existing_products = getProduct();
if ($existing_products && count($existing_products) > 0) {
    echo "<h3>⚠️ Database already contains " . count($existing_products) . " products.</h3>";
    echo "<p>Seeding skipped to prevent duplicates. If you want to re-seed, please truncate the products table first.</p>";
    exit;
}

// Seed the database
$success_count = 0;
foreach ($products as $product) {
    if (storeProduct($product)) {
        $success_count++;
    }
}

echo "<h3>✅ Database seeded successfully!</h3>";
echo "<p>" . $success_count . " out of " . count($products) . " products added.</p>";
echo "<p><a href='/shop.php'>View Products</a> | <a href='/produk/views/produkView.php'>Admin Panel</a></p>";
?>