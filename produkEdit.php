<?php
$pageTitle = "Admin - Edit Produk";
include "partials/header.php";
include_once "database/koneksi.php";
include_once "model/produkModel.php";

$id = $_GET['id'];
if (!$id) {
    header("Location: produkView.php"); 
    exit;
}

$product = getProductById($connection, $id);

if (!$product) {
    echo "Produk tidak ditemukan!";
    exit;
}
?>
<main class="container my-4">

    <div class="row justify-content-center">
        <div class="col-lg-8"> <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Edit Produk</h4>
                </div>
                <div class="card-body p-4">
                    
                    <form action="produkUpdate.php" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" name="price" id="price" value="<?php echo $product['price']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="imageFile" class="form-label">Ganti Gambar (Opsional)</label>
                            <input type="file" class="form-control" name="imageFile" id="imageFile" accept=".jpg, .jpeg, .png, .gif">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengganti gambar.</div>
                            
                            <label class="form-label mt-2">Gambar Saat Ini:</label><br>
                            <?php if ($product['image'] && file_exists($product['image'])): ?>
                                <img src="<?php echo $product['image']; ?>" width="150" class="img-thumbnail">
                            <?php else: ?>
                                <span class="text-muted small">(Tidak ada gambar)</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <input type="text" class="form-control" name="category" id="category" value="<?php echo htmlspecialchars($product['category']); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tags" class="form-label">Tag</label>
                                <input type="text" class="form-control" name="tags" id="tags" value="<?php echo htmlspecialchars($product['tags']); ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" id="description" rows="5"><?php echo htmlspecialchars($product['description']); ?></textarea>
                        </div>

                        <hr class="my-4">
                        
                        <div class="d-grid"> <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Update Produk">
                        </div>
                    </form>
                </div> 
            </div> 
        </div>
    </div>
</main>
<?php
include "partials/footer.php";
?>