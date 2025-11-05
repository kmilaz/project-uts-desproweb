<?php
include_once "database/koneksi.php";
include_once "model/produkModel.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $product = getProductById($connection, $id);
    if ($product['image'] && file_exists($product['image'])) {
        unlink($product['image']);
    }

    $delete = deleteProduct($connection, $id);

    if ($delete) {
        echo "Produk berhasil dihapus.";
    } else {
        echo "Gagal menghapus produk: " . pg_last_error($connection);
    }

    header("Location: produkView.php");

} else {
    header("Location: produkView.php");
}
?>