<?php
$host = 'localhost';
$port = '5432';
$user = 'postgres';
$pass = '12345678';
$database = 'dainty_doodles';

$connection = pg_connect("host=$host port=$port dbname=$database user=$user password=$pass");
if (!$connection) {
    $errorMessage = pg_last_error();
    die("connection failed, error: $errorMessage");
}

if (pg_set_client_encoding($connection, 'UTF8') == 1) {
    $errorMessage = pg_last_error();
    die("fail to set enconding, error: $errorMessage");
}

function query($sql, $connection) {
    $result = pg_query($connection, $sql);

    if (!$result) {
        $errorMessage = pg_last_error();
        die("fail to query, error: $errorMessage");
    }

    return $result;
}
?>