<?php
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

    // Mengambil ID dari URL menggunakan $_GET
    $productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $product = null;

    // Cari produk di dalam array berdasarkan ID
    foreach ($products as $p) {
        if ($p['id'] === $productId) {
            $product = $p;
            break;
        }
    }

    if (!$product) {
        $pageTitle = "Produk Tidak Ditemukan";
        include 'partials/header.php';
        echo "<main><p style='text-align:center; padding: 50px;'>Produk tidak ditemukan.</p></main>";
        include 'partials/footer.php';
        exit; 
    }
    
    $pageTitle = $product['name']; 
    include 'partials/header.php';
?>

<main>
    <div class="breadcrumb">
        <p>Home > Shop > <?php echo htmlspecialchars($product['name']); ?></p>
    </div>

    <section class="single-product-layout">
        <div class="product-image">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>

        <div class="product-details">
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
            <h2>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></h2>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            
            <div class="product-actions">
                <input type="hidden" value=<?php echo htmlspecialchars($product['id']); ?> id="hiddenId">
                <input type="number" value="1" min="1" class="quantity-input" id="quantity">
                <button class="btn-utama" id="add-to-cart-btn">Add To Cart</button>
            </div>

            <div class="product-meta">
                <p><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
                <p><strong>Tags:</strong> <?php echo htmlspecialchars($product['tags']); ?></p>
            </div>
        </div>
    </section>

    </main>

<?php 
    include 'partials/footer.php';
?>