<?php
// Application Configuration

// Base paths
define('BASE_PATH', __DIR__ . '/..');
define('BASE_URL', '/');

// Directory paths
define('MODEL_PATH', BASE_PATH . '/model');
define('DATABASE_PATH', BASE_PATH . '/database');
define('PARTIALS_PATH', BASE_PATH . '/partials');
define('STORAGE_PATH', BASE_PATH . '/storage');
define('ASSETS_PATH', BASE_PATH . '/assets');

// URL paths
define('ASSETS_URL', BASE_URL . 'assets');
define('STORAGE_URL', BASE_URL . 'storage');

// Database configuration (keep in koneksi.php for now, but could move here later)

// Session configuration
define('SESSION_NAME', 'dainty_doodles_session');
define('SESSION_LIFETIME', 3600); // 1 hour

// Admin credentials (TEMPORARY - will move to database later)
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', password_hash('admin123', PASSWORD_DEFAULT));
?>
