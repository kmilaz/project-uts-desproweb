<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if admin is logged in
function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// Check if customer is logged in
function isCustomerLoggedIn() {
    return isset($_SESSION['customer_logged_in']) && $_SESSION['customer_logged_in'] === true;
}

// Require admin authentication (redirect to login if not logged in)
function requireAuth() {
    if (!isLoggedIn()) {
        header('Location: /auth/views/login.php');
        exit;
    }
}

// Require customer authentication (redirect to customer login if not logged in)
function requireCustomerAuth() {
    if (!isCustomerLoggedIn()) {
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        header('Location: /auth/views/login.php');
        exit;
    }
}

// Admin login function
function login($username, $password) {
    require_once __DIR__ . '/../config/config.php';
    
    if ($username === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        $_SESSION['login_time'] = time();
        return true;
    }
    return false;
}

// Logout function (admin)
function logout() {
    session_destroy();
    header('Location: /auth/views/login.php');
    exit;
}

// Customer logout function
function logoutCustomer() {
    session_destroy();
    header('Location: /index.php');
    exit;
}

// Check session timeout
function checkSessionTimeout() {
    require_once __DIR__ . '/../config/config.php';
    
    if (isset($_SESSION['login_time'])) {
        $elapsed = time() - $_SESSION['login_time'];
        if ($elapsed > SESSION_LIFETIME) {
            if (isLoggedIn()) {
                logout();
            } else if (isCustomerLoggedIn()) {
                logoutCustomer();
            }
        }
    }
}

// Get current customer data
function getCurrentCustomer() {
    if (isCustomerLoggedIn()) {
        require_once __DIR__ . '/../model/userModel.php';
        return getCustomerById($_SESSION['customer_id']);
    }
    return null;
}
?>
