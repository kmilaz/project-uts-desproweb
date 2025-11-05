<?php
function storeProduct($connection, $data)
{
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

function updateProduct($connection, $id, $data)
{
    $params = [
        $data['name'],
        $data['price'],
        $data['category'],
        $data['tags'],
        $data['description'],
        $id 
    ];

    $sql = "UPDATE products SET 
                name = $1,
                price = $2,
                category = $3,
                tags = $4,
                description = $5
            WHERE id = $6";

    $result = pg_query_params($connection, $sql, $params);
    return $result;
}

function deleteProduct($connection, $id)
{
    $sql = "DELETE FROM products WHERE id = $1";
    $result = pg_query_params($connection, $sql, [$id]);
    return $result;
}

function getProduct($connection)
{
    $sql = "SELECT * FROM products ORDER BY id DESC";
    $result = pg_query($connection, $sql);
    return pg_fetch_all($result, PGSQL_ASSOC);
}

function getProductById($connection, $id) 
{
    $sql = "SELECT * FROM products WHERE id = $1";
    $result = pg_query_params($connection, $sql, [$id]);
    return pg_fetch_assoc($result);
}

?>