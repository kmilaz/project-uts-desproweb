<?php
include_once "database/koneksi.php";
include_once "model/produkModel.php";

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $data = $_POST;

    $update = updateProduct($connection, $id, $data);

    if ($update) {
        echo "Produk berhasil diperbarui.";
        header("Location: produkView.php");
    } else {
        echo "Gagal memperbarui produk: " . pg_last_error($connection);
    }
} else {
    header("Location: produkView.php");
}
?>