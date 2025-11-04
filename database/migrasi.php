<?php
require_once 'koneksi.php';

$productSql = 'CREATE TABLE IF NOT EXISTS "products"(
    "id" SERIAL PRIMARY KEY,
    "name" VARCHAR(50) NOT NULL,
    "price" INT NOT NULL,
    "image" VARCHAR(100),
    "category" VARCHAR(20),
    "tags" TEXT,
    "description" TEXT
);';
query($productSql, $connection);
?>