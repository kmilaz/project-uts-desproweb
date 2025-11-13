<?php 
    session_start();
    
    // Check if customer is logged in
    if (!isset($_SESSION['customer_logged_in']) || $_SESSION['customer_logged_in'] !== true) {
        // Store the current cart data and redirect to login
        if (isset($_POST['cart_data'])) {
            $_SESSION['pending_cart_data'] = $_POST['cart_data'];
        }
        $_SESSION['redirect_after_login'] = '/checkout.php';
        header('Location: /auth/views/login.php');
        exit;
    }
    
    // Get customer data
    require_once 'model/userModel.php';
    $customer = getCustomerById($_SESSION['customer_id']);
    
    $pageTitle = "Checkout";
    include 'partials/header.php';
    include_once 'model/produkModel.php';

    // --- BLOK KODE UNTUK ESTAFET DATA KERANJANG ---
    $cart_data_string_php = '';
    $initial_cart_js = '[]'; // Default keranjang kosong untuk JavaScript

    // Check if cart data is in POST or session
    if (isset($_POST['cart_data']) && !empty($_POST['cart_data'])) {
        $cart_data_string_php = $_POST['cart_data'];
    } elseif (isset($_SESSION['pending_cart_data'])) {
        $cart_data_string_php = $_SESSION['pending_cart_data'];
        unset($_SESSION['pending_cart_data']);
    }
    
    if (!empty($cart_data_string_php)) {
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
    $cart_data_string = $cart_data_string_php;
    if (!empty($cart_data_string)) {
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
                <p>Logged in as: <strong><?php echo htmlspecialchars($_SESSION['customer_name']); ?></strong> 
                   (<a href="/auth/customer_logout.php">Logout</a>)</p>
                <p><label for="first_name">First Name </label><input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($customer['first_name']); ?>" required></p>
                <p><label for="last_name">Last Name </label><input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($customer['last_name']); ?>" required></p>
                <p><label for="street_address">Street Address </label><input type="text" id="street_address" name="street_address" value="<?php echo htmlspecialchars($customer['street_address'] ?? ''); ?>" required></p>
                <p><label for="phone">Phone </label><input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($customer['phone'] ?? ''); ?>" required></p>
                <p><label for="email_address">Email address </label><input type="email" id="email_address" name="email_address" value="<?php echo htmlspecialchars($customer['email']); ?>" required readonly></p>
                <input type="hidden" name="customer_id" value="<?php echo $customer['id']; ?>">
            </div>

            <div class="order-summary">
                <h3>Your Order</h3>
                <?php
                $total = 0;
                if (empty($cart_items_processed)) {
                    echo "<p>Keranjang Anda kosong.</p>";
                } else {
                    foreach ($cart_items_processed as $item) {
                        $product_detail = getProductById($item['id']);
                        if ($product_detail) {
                            $subtotal = $product_detail['price'] * $item['quantity'];
                            $total += $subtotal;
                            echo "<p>" . htmlspecialchars($product_detail['name']) . " x " . $item['quantity'] . " <span>Rp " . number_format($subtotal) . "</span></p>";
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