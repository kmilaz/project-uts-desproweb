<?php
session_start();
require_once __DIR__ . '/../model/userModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $data = [
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? '',
        'first_name' => $_POST['first_name'] ?? '',
        'last_name' => $_POST['last_name'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'street_address' => $_POST['street_address'] ?? ''
    ];
    
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    // Validate password match
    if ($data['password'] !== $confirmPassword) {
        $_SESSION['register_error'] = 'Passwords do not match';
        header('Location: /auth/views/register.php');
        exit;
    }
    
    // Validate password length
    if (strlen($data['password']) < 6) {
        $_SESSION['register_error'] = 'Password must be at least 6 characters';
        header('Location: /auth/views/register.php');
        exit;
    }
    
    // Register customer
    $result = registerCustomer($data);
    
    if ($result['success']) {
        $_SESSION['register_success'] = 'Registration successful! Please login.';
        header('Location: /auth/views/login.php');
        exit;
    } else {
        $_SESSION['register_error'] = $result['message'];
        header('Location: /auth/views/register.php');
        exit;
    }
} else {
    // Direct access not allowed
    header('Location: /auth/views/register.php');
    exit;
}
?>
