<?php
session_start();

// Clear customer session
unset($_SESSION['customer_logged_in']);
unset($_SESSION['customer_id']);
unset($_SESSION['customer_email']);
unset($_SESSION['customer_name']);

session_destroy();

header('Location: /index.php');
exit;
?>
