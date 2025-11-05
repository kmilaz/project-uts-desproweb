<?php 
    $pageTitle = "Shop";
    include 'partials/header.php';
    include_once "model/produkModel.php";

    // --- BLOK KODE UNTUK ESTAFET DATA KERANJANG ---
    $cart_data_string_php = '';
    $initial_cart_js = '[]'; // Default keranjang kosong untuk JavaScript

    if (isset($_POST['cart_data']) && !empty($_POST['cart_data'])) {
        // Ambil data keranjang dari halaman sebelumnya
        $cart_data_string_php = $_POST['cart_data'];

        // Siapkan data untuk dioper ke JavaScript
        $items_pairs = explode(',', $cart_data_string_php);
        $cart_array_for_js = [];
        foreach ($items_pairs as $pair) {
            // var_dump($pair);
            $details = explode(':', $pair);
            // var_dump($details);
            if(count($details) == 2){
                $cart_array_for_js[] = ['id' => $details[0], 'quantity' => (int)$details[1]];
            }
        }
        // Ubah array PHP menjadi format JSON/JavaScript object
        $initial_cart_js = json_encode($cart_array_for_js);
    }
    // --- AKHIR BLOK KODE ESTAFET ---

    require_once 'database/koneksi.php';
    $selectSql = 'SELECT * FROM "products"';
    $result = pg_query($connection, $selectSql);
?>

<main>
    <div class="page-header">
        <h1>Shop</h1>
        <p>Home > Shop</p>
    </div>

    <section class="shop-content">
        <div class="product-grid shop-grid">
            <?php while($row = pg_fetch_assoc($result)):?>
            <div class="product-card">
                <a href="#" onclick="navigateTo('produk.php?id=<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8')?>')">
                    <img src="<?= htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?>">
                    <h4><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></h4>
                    <p>Rp <?= htmlspecialchars(number_format($row['price'], 0, ',', '.'), ENT_QUOTES, 'UTF-8') ?></p>
                </a>
            </div>
            <?php endwhile?>
        </div>
    </section>
</main>

<?php 
    include 'partials/footer.php';
?>