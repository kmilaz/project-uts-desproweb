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
    <title>Login - Dainty Doodles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Welcome Back</h2>
                <p class="subtitle">Login to continue shopping</p>
            </div>
            
            <?php
            if (isset($_SESSION['login_error'])) {
                echo '<div class="error-message"><i class="fa-solid fa-circle-exclamation"></i> ' . htmlspecialchars($_SESSION['login_error']) . '</div>';
                unset($_SESSION['login_error']);
            }
            if (isset($_SESSION['register_success'])) {
                echo '<div class="success-message"><i class="fa-solid fa-circle-check"></i> ' . htmlspecialchars($_SESSION['register_success']) . '</div>';
                unset($_SESSION['register_success']);
            }
            ?>
            
            <!-- Unified Login Form -->
            <form action="/auth/authenticate.php" method="POST">
                <div class="mb-3">
                    <label for="username_email" class="form-label">Email or Username</label>
                    <input type="text" class="form-control" id="username_email" name="username_email" required autofocus placeholder="Enter your email or username">
                    <small class="text-muted">Use email for customer login or username for admin</small>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                </div>
                <button type="submit" class="btn-primary">Login</button>
            </form>
            
            <div class="divider">
                <span>New Customer?</span>
            </div>
            
            <a href="/auth/views/register.php" class="btn-outline-primary">Create New Account</a>
            
            <div class="back-link">
                <a href="/"><i class="fa-solid fa-arrow-left"></i> Back to Store</a>
            </div>
        </div>
    </div>
</body>
</html>