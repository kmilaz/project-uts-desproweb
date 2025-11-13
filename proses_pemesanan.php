<?php 
    $pageTitle = "Pesanan Diterima";
    include 'partials/header.php';
    include_once "model/produkModel.php";

    $products = getProduct(); // Butuh data produk untuk detail

    // --- BLOK KODE UNTUK ESTAFET DATA KERANJANG ---
    $cart_data_string_php = '';
    // After successful order, clear the cart by keeping it empty
    $initial_cart_js = '[]'; // Keranjang dikosongkan setelah pemesanan berhasil

    if (isset($_POST['cart_data']) && !empty($_POST['cart_data'])) {
        // Ambil data keranjang untuk ditampilkan di ringkasan
        $cart_data_string_php = $_POST['cart_data'];
        // NOTE: We don't populate $initial_cart_js here because we want to clear the cart after checkout
    }
    // --- AKHIR BLOK KODE ESTAFET ---
?>

<main>
    <div class="container-proses">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Mengambil data pelanggan
            $firstName = htmlspecialchars($_POST['first_name']);
            $lastName = htmlspecialchars($_POST['last_name']);
            $address = htmlspecialchars($_POST['street_address']);
            $phone = htmlspecialchars($_POST['phone']);
            $email = htmlspecialchars($_POST['email_address']);
            
            echo "<h1>Pesanan Berhasil Dibuat!</h1>";
            echo "<p>Terima kasih, <strong>" . $firstName . " " . $lastName . "</strong>. Pesanan Anda sedang kami proses.</p>";
            echo "<hr>";

            // Memproses dan menampilkan detail produk yang dipesan
            echo "<h4>Ringkasan Pesanan:</h4>";
            if (isset($_POST['cart_data']) && !empty($_POST['cart_data'])) {
                $cart_data_string = $_POST['cart_data'];
                $items_pairs = explode(',', $cart_data_string);
                $total_final = 0;

                foreach ($items_pairs as $pair) {
                    $details = explode(':', $pair);
                    $item_id = (int)$details[0];
                    $item_qty = (int)$details[1];

                    // Cari detail produk
                    foreach ($products as $p) {
                        if ($p['id'] == $item_id) {
                            $subtotal = $p['price'] * $item_qty;
                            $total_final += $subtotal;
                            echo "<p>" . htmlspecialchars($p['name']) . " x " . $item_qty . " = Rp " . number_format($subtotal) . "</p>";
                            break;
                        }
                    }
                }
                echo "<p><strong>Total Pesanan: Rp " . number_format($total_final) . "</strong></p>";
            }
            
            echo "<hr>";
            echo "<h4>Alamat Pengiriman:</h4>";
            echo "<p>" . $address . "</p>";
            echo "<p>Telepon: " . $phone . "</p>";
            echo "<p>Kami akan mengirimkan detail pesanan ke email <strong>" . $email . "</strong>.</p>";

        } else {
            echo "<h1>Akses Ditolak</h1>";
            echo "<p>Silakan selesaikan pesanan Anda melalui halaman checkout.</p>";
        }
        ?>
        <a href="shop.php" class="btn-sekunder">Kembali ke Toko</a>
    </div>
</main>

<?php 
    include 'partials/footer.php';
?>