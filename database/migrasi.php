<?php
require_once __DIR__ . '/koneksi.php';

// Run migration only if table doesn't exist
$check_table_sql = "SELECT EXISTS (
    SELECT FROM information_schema.tables 
    WHERE table_schema = 'public' 
    AND table_name = 'products'
);";

$result = pg_query(get_connection(), $check_table_sql);
$row = pg_fetch_assoc($result);

if ($row['exists'] === 'f') {
    // Table doesn't exist, create it
    $productSql = 'CREATE TABLE IF NOT EXISTS "products"(
        "id" SERIAL PRIMARY KEY,
        "name" VARCHAR(50) NOT NULL,
        "price" INT NOT NULL,
        "image" VARCHAR(100),
        "category" VARCHAR(20),
        "tags" TEXT,
        "description" TEXT
    );';
    query($productSql);
}

// Check and create customers table
$check_customers_sql = "SELECT EXISTS (
    SELECT FROM information_schema.tables 
    WHERE table_schema = 'public' 
    AND table_name = 'customers'
);";

$result = pg_query(get_connection(), $check_customers_sql);
$row = pg_fetch_assoc($result);

if ($row['exists'] === 'f') {
    // Table doesn't exist, create it
    $customersSql = 'CREATE TABLE IF NOT EXISTS "customers"(
        "id" SERIAL PRIMARY KEY,
        "email" VARCHAR(100) NOT NULL UNIQUE,
        "password" VARCHAR(255) NOT NULL,
        "first_name" VARCHAR(50) NOT NULL,
        "last_name" VARCHAR(50) NOT NULL,
        "phone" VARCHAR(20),
        "street_address" TEXT,
        "created_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );';
    query($customersSql);
    echo "Customers table created successfully.<br>";
}
?>