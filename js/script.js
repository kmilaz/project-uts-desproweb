// Menunggu dokumen siap (standar jQuery)
$(document).ready(function(){

    // Contoh: Tambahkan class 'scrolled' pada header saat halaman di-scroll
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.header').addClass('scrolled');
        } else {
            $('.header').removeClass('scrolled');
        }
    });

    // Kode interaktif lainnya akan ditambahkan di sini.
    // Misalnya:
    // 1. Logika untuk membuka sidebar keranjang belanja
    // 2. Fungsi untuk filter produk di halaman Shop
    // 3. Validasi form di halaman Kontak dan Checkout

});