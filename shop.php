<?php 
    $pageTitle = "Shop";
    include 'partials/header.php';
    include 'data/produk_data.php';

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
            $details = explode(':', $pair);
            if(count($details) == 2){
                $cart_array_for_js[] = ['id' => $details[0], 'quantity' => (int)$details[1]];
            }
        }
        // Ubah array PHP menjadi format JSON/JavaScript object
        $initial_cart_js = json_encode($cart_array_for_js);
    }
    // --- AKHIR BLOK KODE ESTAFET ---
?>

<main>
    <div class="page-header">
        <h1>Shop</h1>
        <p>Home > Shop</p>
    </div>

    <section class="shop-content">
        <div class="product-grid shop-grid">
             <?php 
                foreach ($products as $product) {
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
</main>

<?php 
    include 'partials/footer.php';
?>