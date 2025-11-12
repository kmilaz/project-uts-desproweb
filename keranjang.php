<?php 
    $pageTitle = "Keranjang Belanja";
    include 'partials/header.php';
    include_once 'model/produkModel.php';

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

    if (isset($_POST['cart_data']) && !empty($_POST['cart_data'])) {
        $cart_data_string = $_POST['cart_data']; 
        
        // Pecah string menjadi pasangan "id:qty" menggunakan explode()
        $items_pairs = explode(',', $cart_data_string);

        foreach ($items_pairs as $pair) {
            // Pecah setiap pasangan menjadi "id" dan "qty"
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
        <h1>Cart</h1>
        <p>Home > Cart</p>
    </div>

    <section class="cart-section">
        <table class="cart-table">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($cart_items_processed)): ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">Keranjang belanja Anda kosong.</td>
                    </tr>
                <?php else: ?>
                    <?php
                    $total = 0;
                    foreach ($cart_items_processed as $item):
                        $product_detail = getProductById($item['id']);
                        if ($product_detail):
                            $subtotal = $product_detail['price'] * $item['quantity'];
                            $total += $subtotal;
                    ?>
                            <tr>
                                <td><img src="<?php echo $product_detail['image']; ?>" alt="" width="80"></td>
                                <td><?php echo $product_detail['name']; ?></td>
                                <td>Rp <?php echo number_format($product_detail['price']); ?></td>
                                <td><?php echo $item['quantity']; ?></td>
                                <td>Rp <?php echo number_format($subtotal); ?></td>
                            </tr>
                    <?php
                        endif;
                    endforeach;
                    ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="cart-totals">
            <h3>Cart Totals</h3>
            <p><strong>Total:</strong> <strong>Rp <?php echo isset($total) ? number_format($total) : '0'; ?></strong></p>
            
            <form action="checkout.php" method="POST">
                <?php
                    if (isset($_POST['cart_data'])) {
                        echo '<input type="hidden" name="cart_data" value="' . htmlspecialchars($_POST['cart_data']) . '">';
                    }
                ?>
                <button type="submit" class="btn-utama" style="width:100%;">Proceed to Checkout</button>
            </form>
        </div>
        </section>
</main>

<?php 
    include 'partials/footer.php';
?>