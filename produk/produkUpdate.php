<?php

include_once "../model/produkModel.php";

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $data = $_POST;

    $new_image_path = null;
    $old_image_path = null;

    if (isset($_FILES["imageFile"]) && $_FILES["imageFile"]["error"] == 0 && $_FILES["imageFile"]["size"] > 0) {
        $targetdir = "../storage/";
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        $maxsize = 3 * 1024 * 1024;

        $originalFileName = $_FILES["imageFile"]["name"];
        $fileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

        if (in_array($fileType, $allowedExtensions) && $_FILES["imageFile"]["size"] <= $maxsize) {
            $newFileName = uniqid("img_") . "_" . time() . "." . $fileType;
            $targetfile = $targetdir . $newFileName;

            if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $targetfile)) {
                $new_image_path = "storage/" . $newFileName;
                $data['image'] = $new_image_path; 
            } else {
                die("Gagal memindahkan file gambar baru.");
            }
        } else {
            die("File gambar baru tidak valid (format atau ukuran).");
        }

        $old_product = getProductById($id);
        if ($old_product && !empty($old_product['image'])) {
            $old_image_path = $old_product['image'];
        }

    } 

    $update = updateProduct($id, $data);

    if ($update) {
        if ($new_image_path && $old_image_path && file_exists("../" . $old_image_path)) {
            unlink("../" . $old_image_path); 
        }
        
        echo "Produk berhasil diperbarui.";
        header("Location: views/produkView.php"); 
        exit;
    } else {
        echo "Gagal memperbarui produk: " . pg_last_error(get_connection());
        if ($new_image_path && file_exists("../" . $new_image_path)) {
            unlink("../" . $new_image_path);
        }
    }

} else {
    header("Location: views/produkView.php");
}
?>