$(document).ready(function() {
    // 1. Variabel keranjang.
    var cart = typeof initialCartData !== 'undefined' ? initialCartData : [];
    updateCartCount(); // Langsung update hitungan saat halaman dimuat

    // 2. Logika untuk tombol "Add to Cart" (tetap sama)
    $('#add-to-cart-btn').on("click", function() {
        var productId = $('#hiddenId').val();
        var quantity = parseInt($('#quantity').val());

        var productExists = false;
        for (var i = 0; i < cart.length; i++) {
            if (cart[i].id == productId) { 
                cart[i].quantity += quantity;
                productExists = true;
                break;
            }
        }

        if (!productExists) {
            cart.push({ id: productId, quantity: quantity });
        }
        
        updateCartCount();
        // alert("Produk ditambahkan ke keranjang!");
    });

    // 3. Fungsi untuk memperbarui angka di ikon keranjang (tetap sama)
    function updateCartCount() {
        var totalItems = 0;
        if (cart) {
            for (var i = 0; i < cart.length; i++) {
                totalItems += cart[i].quantity;
            }
        }
        $('#cart-count').text(totalItems);
    }
    
    // 4. Logika untuk tombol "Lihat Keranjang" (tetap sama)
    $('#view-cart-btn').click(function(e) {
        e.preventDefault();
        var cartDataString = cart.map(function(item) {
            return item.id + ':' + item.quantity;
        }).join(',');
        $('#cart-data-input').val(cartDataString);
        $('#cart-form').submit();
    });

    // 5. Fungsi navigasi baru untuk semua link
    window.navigateTo = function(url) {
        // Ambil data keranjang saat ini
        var cartDataString = cart.map(function(item) {
            return item.id + ':' + item.quantity;
        }).join(',');

        // Masukkan data keranjang ke form navigasi
        $('#nav-cart-data').val(cartDataString);

        // Atur tujuan form dan kirim
        $('#nav-form').attr('action', url).submit();
    }

});