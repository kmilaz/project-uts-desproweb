<?php 
    $pageTitle = "Home"; 
    include 'partials/header.php'; 
    include 'data/produk_data.php'; 
    // --- BLOK KODE UNTUK ESTAFET DATA KERANJANG ---
    $cart_data_string_php = '';
    $initial_cart_js = '[]'; // Default keranjang kosong untuk JavaScript

    if (isset($_POST['cart_data']) && !empty($_POST['cart_data'])) {
        // Mengambil data keranjang dari halaman sebelumnya
        $cart_data_string_php = $_POST['cart_data'];

        // Siapkan data untuk dioper ke JavaScript
        $items_pairs = explode(',', $cart_data_string_php);
        $cart_array_for_js = [];
        foreach ($items_pairs as $pair) {
            $details = explode(':', $pair);
            if(count($details) == 2){
                $cart_array_for_js[] = ['id' => $details[0], 'quantity' => (int)$details[1]];
            }
        }
        // Mengubah array PHP menjadi format JSON/JavaScript object
        $initial_cart_js = json_encode($cart_array_for_js);
    }
    // --- AKHIR BLOK KODE ESTAFET ---
?>

<main>
    <section class="hero">
        <div class="hero-content">
            <h1>Discover Our<br>New Collection</h1>
            <p>Temukan koleksi perhiasan terbaru kami dengan desain yang elegan dan penuh warna. Hadirkan sentuhan unik untuk gaya kamu sehari-hari!</p>
            <button class="btn-utama" onclick="window.location.href='shop.php'">Shop Now</button>
        </div>
    </section>

    <section class="products-range" >
        <img src="assets/img/products-range.png" alt="range">
    </section>

    <section class="products">
        <h2>Our Products</h2>
        <div class="product-grid">
            <?php 
                for ($i = 0; $i < 3 && $i < count($products); $i++) {
                    $product = $products[$i];
                    echo '<div class="product-card">';
                    echo '<a href="#" onclick="navigateTo(\'produk.php?id=' . $product["id"] . '\')">';
                    echo '<img src="' . $product["image"] . '" alt="' . $product["name"] . '">';
                    echo '<h4>' . $product["name"] . '</h4>';
                    echo '<p>Rp ' . number_format($product["price"], 0, ',', '.') . '</p>';
                    echo '</a>';
                    echo '</div>';
                }
            ?>
        </div>
    </section>

    <section class="share">
        <img src="assets/img/share.png" alt="share">
    </section>
</main>

<?php 
    include 'partials/footer.php'; 
?>