<?php
    session_start();
    // Check if customer is logged in
    require_once __DIR__ . '/auth/auth_helper.php';
    requireCustomerAuth();
    
    // Get customer data
    require_once 'model/userModel.php';
    $customer = getCustomerById($_SESSION['customer_id']);

    $pageTitle = "Contact";
    include 'partials/header.php';
?>
<main>
    <div class="page-header">
        <h1>Contact</h1>
        <p>Home > Contact</p>
    </div>

    <section class="contact-section">
        <div class="contact-info">
            <h3>Get In Touch With Us</h3>
            <p>For More Information About Our Product & Services. Please Feel Free To Drop Us An Email. Our Staff Always Be There To Help You Out, Do Not Hesitate!</p>
            <div class="info-item">
                <strong>Address:</strong>
                <p>123 Fifth Ave, New York, NY 10160, United States</p>
            </div>
            <div class="info-item">
                <strong>Phone:</strong>
                <p>Mobile: +(84) 546-6789</p>
            </div>
            <div class="info-item">
                <strong>Working Time:</strong>
                <p>Monday-Friday: 9:00 - 22:00</p>
            </div>
        </div>
        <div class="contact-form">
            <form action="proses_kontak.php" method="POST">
                <label for="nama">Your name</label>
                <input type="text" id="nama" name="nama" placeholder="Your Name" required>

                <label for="email">Email address</label>
                <input type="email" id="email" name="email" placeholder="YourEmail@xxx.com" required>

                <label for="subjek">Subject</label>
                <input type="text" id="subjek" name="subjek" placeholder="This is an optional">

                <label for="pesan">Message</label>
                <textarea id="pesan" name="pesan" rows="5" placeholder="Hi! i'd like to ask about"></textarea>

                <button type="submit" class="btn-utama">Submit</button>
            </form>
        </div>
    </section>
</main>
<?php 
    include 'partials/footer.php';
?>