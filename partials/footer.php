<footer class="footer">
        <div class="footer-container">
            <div class="footer-col">
                <h4>Dainty Doodles.</h4>
                <p>400 University Drive Suite 200 Coral Gables,<br>FL 33134 USA</p>
            </div>
            <div class="footer-col">
                <h4>Links</h4>
                <a href="index.php">Home</a>
                <a href="shop.php">Shop</a>
                <a href="#">About</a>
                <a href="kontak.php">Contact</a>
            </div>
            <div class="footer-col">
                <h4>Help</h4>
                <a href="#">Payment Options</a>
                <a href="#">Returns</a>
                <a href="#">Privacy Policies</a>
            </div>
            <div class="footer-col">
                <h4>Newsletter</h4>
                <form action="#" method="POST">
                    <input type="email" placeholder="Enter Your Email Address">
                    <button type="submit">SUBSCRIBE</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>2025 DaintyDoodles. All rights reserved</p>
        </div>
    </footer>

    <script>
        var initialCartData = <?php echo isset($initial_cart_js) ? $initial_cart_js : '[]'; ?>;
    </script>

    <script src="assets/jquery/jquery-3.7.1.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>