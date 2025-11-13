<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Dainty Doodles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <h2>Create Account</h2>
                <p class="subtitle">Join us and start shopping</p>
            </div>
            
            <?php
            if (isset($_SESSION['register_error'])) {
                echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . htmlspecialchars($_SESSION['register_error']) . '</div>';
                unset($_SESSION['register_error']);
            }
            if (isset($_SESSION['register_success'])) {
                echo '<div class="success-message"><i class="fa-solid fa-circle-check"></i> ' . htmlspecialchars($_SESSION['register_success']) . '</div>';
                unset($_SESSION['register_success']);
            }
            ?>
            
            <form action="/auth/register.php" method="POST">
                <div class="form-row">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name *</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required placeholder="John">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name *</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required placeholder="Doe">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address *</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="john@example.com">
                </div>
                
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="+62 812 3456 7890">
                </div>
                
                <div class="mb-3">
                    <label for="street_address" class="form-label">Street Address</label>
                    <textarea class="form-control" id="street_address" name="street_address" rows="2" placeholder="Enter your full address"></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password *</label>
                    <input type="password" class="form-control" id="password" name="password" required minlength="6" placeholder="Minimum 6 characters">
                    <small class="text-muted">Must be at least 6 characters</small>
                </div>
                
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password *</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required placeholder="Re-enter your password">
                </div>
                
                <button type="submit" class="btn-primary">Create Account</button>
            </form>
            
            <div class="login-link">
                Already have an account? <a href="/auth/views/login.php">Login here</a>
            </div>
            
            <div class="back-link">
                <a href="/"><i class="fa-solid fa-arrow-left"></i> Back to Store</a>
            </div>
        </div>
    </div>
    
    <script>
        // Validate password match on submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
            }
        });
    </script>
</body>
</html>