<?php 
    $pageTitle = "Terima Kasih";
    include 'partials/header.php';
?>

<main>
    <div class="container-proses">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '';
            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
            $subjek = isset($_POST['subjek']) ? htmlspecialchars($_POST['subjek']) : '';
            $pesan = isset($_POST['pesan']) ? htmlspecialchars($_POST['pesan']) : '';

            echo "<h1>Pesan Terkirim!</h1>";
            echo "<p>Terima kasih, <strong>" . $nama . "</strong>. Kami telah menerima pesan Anda.</p>";
            echo "<p>Kami akan segera membalas ke alamat email: <strong>" . $email . "</strong></p>";
            echo "<hr>";
            echo "<h4>Detail Pesan:</h4>";
            echo "<p><strong>Subjek:</strong> " . $subjek . "</p>";
            echo "<p><strong>Pesan:</strong><br>" . nl2br($pesan) . "</p>";
        } else {
            echo "<h1>Akses Ditolak</h1>";
            echo "<p>Silakan isi formulir kontak terlebih dahulu.</p>";
        }
        ?>
        <a href="kontak.php" class="btn-sekunder">Kembali ke Form Kontak</a>
    </div>
</main>

<?php 
    include 'partials/footer.php';
?>