<?php

$pageTitle = "Admin - Daftar Produk";
include "../../partials/admin_header.php"; 
include_once "../../model/produkModel.php";

$products = getProduct();
?>

<main class="container my-4">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Manajemen Produk</h4>
                <a href="produkCreate.php" class="btn btn-primary">+ Tambah Produk Baru</a>
            </div>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light"> <tr>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($products && count($products) > 0): ?>
                            <?php foreach ($products as $product): ?>
                            <tr class="align-middle">
                                <td>
                                    <?php if ($product['image'] && file_exists("../../" . $product['image'])): ?>
                                        <img src="../../<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                    <?php else: ?>
                                        <span class="text-muted small">(No Image)</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($product['name']); ?></td>
                                <td>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></td>
                                <td><span class="badge bg-secondary"><?php echo htmlspecialchars($product['category']); ?></span></td>
                                <td>
                                    <a href="produkEdit.php?id=<?php echo $product['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="../produkDelete.php?id=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus produk ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center p-5">
                                    Belum ada data produk.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div> 
    </div> 
</main>

<?php
include "../../partials/admin_footer.php"; 
?>