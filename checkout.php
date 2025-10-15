<?php 
    $pageTitle = "Checkout";
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

    $cart_items_processed = [];
    $cart_data_string = '';
    if (isset($_POST['cart_data']) && !empty($_POST['cart_data'])) {
        $cart_data_string = $_POST['cart_data'];
        $items_pairs = explode(',', $cart_data_string);
        foreach ($items_pairs as $pair) {
            $details = explode(':', $pair);
            if (count($details) == 2) {
                $cart_items_processed[] = [
                    'id' => (int)$details[0],
                    'quantity' => (int)$details[1]
                ];
            }
        }
    }
?>
<main>
    <div class="page-header">
        <h1>Checkout</h1>
        <p>Home > Checkout</p>
    </div>

    <section class="checkout-form-section">
        <form name="checkout" method="post" class="checkout-form" action="proses_pemesanan.php">
            <div class="customer-details">
                <h3>Order details</h3>
                <p><label for="first_name">First Name </label><input type="text" id="first_name" name="first_name" required></p>
                <p><label for="last_name">Last Name </label><input type="text" id="last_name" name="last_name" required></p>
                <p><label for="street_address">Street Address </label><input type="text" id="street_address" name="street_address" required></p>
                <p><label for="phone">Phone </label><input type="tel" id="phone" name="phone" required></p>
                <p><label for="email_address">Email address </label><input type="email" id="email_address" name="email_address" required></p>
            </div>

            <div class="order-summary">
                <h3>Your Order</h3>
                <?php
                $total = 0;
                if (empty($cart_items_processed)) {
                    echo "<p>Keranjang Anda kosong.</p>";
                } else {
                    foreach ($cart_items_processed as $item) {
                        foreach ($products as $p) {
                            if ($p['id'] == $item['id']) {
                                $subtotal = $p['price'] * $item['quantity'];
                                $total += $subtotal;
                                echo "<p>" . htmlspecialchars($p['name']) . " x " . $item['quantity'] . " <span>Rp " . number_format($subtotal) . "</span></p>";
                                break;
                            }
                        }
                    }
                }
                ?>
                <div class="summary-total">
                    <span>Total</span>
                    <strong>Rp <?php echo number_format($total); ?></strong>
                </div>

                <input type="hidden" name="cart_data" value="<?php echo htmlspecialchars($cart_data_string); ?>">

                <button type="submit" class="btn-utama">Place order</button>
            </div>
        </form>
    </section>
</main>
<?php 
    include 'partials/footer.php';
?>