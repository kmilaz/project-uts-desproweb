<?php
require_once __DIR__ . '/../database/koneksi.php';

function storeProduct($data)
{
    $connection = get_connection();
    
    $params = [
        $data['name'],
        $data['price'],
        $data['image'], 
        $data['category'],
        $data['tags'],
        $data['description']
    ];

    $sql = "INSERT INTO products (name, price, image, category, tags, description) 
            VALUES ($1, $2, $3, $4, $5, $6)";
    
    $result = pg_query_params($connection, $sql, $params);
    return $result;
}

function updateProduct($id, $data)
{
    $connection = get_connection();
    
    $params = [
        $data['name'],
        $data['price'],
        $data['image'],
        $data['category'],
        $data['tags'],
        $data['description'],
        $id 
    ];

    $sql = "UPDATE products SET 
                name = $1,
                price = $2,
                image = $3,
                category = $4,
                tags = $5,
                description = $6
            WHERE id = $7";

    $result = pg_query_params($connection, $sql, $params);
    return $result;
}

function deleteProduct($id)
{
    $connection = get_connection();
    
    $sql = "DELETE FROM products WHERE id = $1";
    $result = pg_query_params($connection, $sql, [$id]);
    return $result;
}

function getProduct()
{
    $connection = get_connection();
    
    $sql = "SELECT * FROM products ORDER BY id DESC";
    $result = pg_query($connection, $sql);
    return pg_fetch_all($result, PGSQL_ASSOC);
}

function getProductById($id) 
{
    $connection = get_connection();
    
    $sql = "SELECT * FROM products WHERE id = $1";
    $result = pg_query_params($connection, $sql, [$id]);
    return pg_fetch_assoc($result);
}

?>