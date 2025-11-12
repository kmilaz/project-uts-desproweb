<?php
session_start();
require_once __DIR__ . '/../auth/auth_helper.php';
requireAuth(); // Protect this page

include_once "../model/produkModel.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $product = getProductById($id);
    if ($product['image'] && file_exists("../" . $product['image'])) {
        unlink("../" . $product['image']);
    }

    $delete = deleteProduct($id);

    if ($delete) {
        echo "Produk berhasil dihapus.";
    } else {
        echo "Gagal menghapus produk: " . pg_last_error(get_connection());
    }

    header("Location: views/produkView.php");

} else {
    header("Location: views/produkView.php");
}
?>