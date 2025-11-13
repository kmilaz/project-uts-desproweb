<?php

function get_connection() : \PgSql\Connection {
    $host = 'localhost';
    $port = '5432';
    $user = 'postgres';
    $pass = '12345678';
    $database = 'dainty_doodles';

    static $connection;

    if ($connection instanceof \PgSql\Connection) {
        return $connection;
    }

    $connectionString = "host=$host port=$port dbname=$database user=$user password=$pass";

    $connection = pg_connect($connectionString);

    if (!$connection) {
        $errorMessage = pg_last_error();
        die("connection failed, error: $errorMessage");
    }

    if (pg_set_client_encoding($connection, 'UTF8') == 1) {
        $errorMessage = pg_last_error();
        die("fail to set enconding, error: $errorMessage");
    }

    return $connection;
}

function query($sql) {
    $result = pg_query(get_connection(), $sql);

    if (!$result) {
        $errorMessage = pg_last_error();
        die("fail to query, error: $errorMessage");
    }

    return $result;
}
?>