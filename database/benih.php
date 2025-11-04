<?php
require_once 'koneksi.php';
require_once '../data/produk_data.php';

foreach ($products as $product) {
    $insertQuery = "INSERT INTO products(name, price, image, category, tags, description) VALUES (
        '$product[name]',
        '$product[price]',
        '$product[image]',
        '$product[category]',
        '$product[tags]',
        '$product[description]'
    );";
    query($insertQuery, $connection);
}
?>