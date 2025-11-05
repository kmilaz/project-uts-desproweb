<?php
$pageTitle = "Admin - Create Product";
include "partials/header.php";
?>
<main class="container my-4">

    <div class="row justify-content-center">
        <div class="col-lg-8"> <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Tambah Produk Baru</h4>
                </div>
                <div class="card-body p-4">
                    <form action="produkStore.php" method="POST" enctype="multipart/form-data">
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" name="price" id="price" required>
                        </div>

                        <div class="mb-3">
                            <label for="imageFile" class="form-label">Upload Gambar</label>
                            <input type="file" class="form-control" name="imageFile" id="imageFile" accept=".jpg, .jpeg, .png, .gif">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <input type="text" class="form-control" name="category" id="category">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tags" class="form-label">Tag</label>
                                <input type="text" class="form-control" name="tags" id="tags">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                        </div>

                        <hr class="my-4">
                        
                        <div class="d-grid"> <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Simpan Produk">
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