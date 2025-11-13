<?php
session_start();
require_once __DIR__ . '/auth_helper.php';
require_once __DIR__ . '/../model/userModel.php';
require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = $_POST['username_email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // First, try admin login (check if matches admin username)
    if ($usernameOrEmail === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD)) {
        // Successful admin login
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $usernameOrEmail;
        $_SESSION['login_time'] = time();
        header('Location: /produk/views/produkView.php');
        exit;
    }
    
    // If not admin, try customer login (check if it's an email)
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
        $result = loginCustomer($usernameOrEmail, $password);
        
        if ($result['success']) {
            // Set customer session data
            $_SESSION['customer_logged_in'] = true;
            $_SESSION['customer_id'] = $result['customer']['id'];
            $_SESSION['customer_email'] = $result['customer']['email'];
            $_SESSION['customer_name'] = $result['customer']['first_name'] . ' ' . $result['customer']['last_name'];
            $_SESSION['login_time'] = time();
            
            // Redirect to intended page or home
            if (isset($_SESSION['redirect_after_login'])) {
                $redirect = $_SESSION['redirect_after_login'];
                unset($_SESSION['redirect_after_login']);
                header('Location: ' . $redirect);
            } else {
                header('Location: /index.php');
            }
            exit;
        }
    }
    
    // If we reach here, login failed
    $_SESSION['login_error'] = 'Invalid email/username or password';
    header('Location: /auth/views/login.php');
    exit;
    
} else {
    // Direct access not allowed
    header('Location: /auth/views/login.php');
    exit;
}
?>