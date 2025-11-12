<?php
session_start();
require_once __DIR__ . '/../auth/auth_helper.php';
requireAuth(); // Protect this page

include_once "../model/produkModel.php";

if (isset($_POST['submit'])) {
    $data = $_POST;
    $targetdir = "../storage/";
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $maxsize = 3 * 1024 * 1024;

    if (isset($_FILES["imageFile"]) && $_FILES["imageFile"]["error"] == 0) {
        $originalFileName = $_FILES["imageFile"]["name"];
        $fileSize = $_FILES["imageFile"]["size"];
        $fileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

        $newFileName = uniqid("img_") . "_" . time() . "." . $fileType;
        $targetfile = $targetdir . $newFileName; 

        if (in_array($fileType, $allowedExtensions) && $fileSize <= $maxsize) {
            if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $targetfile)) {
                
                $data['image'] = "storage/" . $newFileName; 
                $simpan = storeProduct($data); 
                
                if ($simpan) {
                    echo "Produk baru berhasil disimpan.";
                    header("Location: views/produkView.php"); 
                    exit;
                } else {
                    echo "Gagal menyimpan data ke database: " . pg_last_error(get_connection());
                    unlink($targetfile); 
                }

            } else {
                echo "Gagal mengunggah file (error saat memindahkan file).";
            }
        } else {
            echo "File tidak valid (hanya JPG/PNG/GIF) atau ukuran melebihi 3MB.";
        }

    } else {
        echo "Tidak ada file yang diunggah atau terjadi error pada file.";
    }
}
?>