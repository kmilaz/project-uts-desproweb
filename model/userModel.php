<?php
require_once __DIR__ . '/../database/koneksi.php';

/**
 * Register a new customer
 * @param array $data Customer data (email, password, first_name, last_name, phone, street_address)
 * @return array ['success' => bool, 'message' => string, 'customer_id' => int]
 */
function registerCustomer($data) {
    $conn = get_connection();
    
    // Validate required fields
    if (empty($data['email']) || empty($data['password']) || 
        empty($data['first_name']) || empty($data['last_name'])) {
        return [
            'success' => false,
            'message' => 'All required fields must be filled'
        ];
    }
    
    // Validate email format
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        return [
            'success' => false,
            'message' => 'Invalid email format'
        ];
    }
    
    // Check if email already exists
    $email = pg_escape_string($conn, $data['email']);
    $checkSql = "SELECT id FROM customers WHERE email = '$email'";
    $result = pg_query($conn, $checkSql);
    
    if (pg_num_rows($result) > 0) {
        return [
            'success' => false,
            'message' => 'Email already registered'
        ];
    }
    
    // Hash password
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    
    // Prepare data
    $firstName = pg_escape_string($conn, $data['first_name']);
    $lastName = pg_escape_string($conn, $data['last_name']);
    $phone = isset($data['phone']) ? pg_escape_string($conn, $data['phone']) : '';
    $address = isset($data['street_address']) ? pg_escape_string($conn, $data['street_address']) : '';
    
    // Insert customer
    $sql = "INSERT INTO customers (email, password, first_name, last_name, phone, street_address) 
            VALUES ('$email', '$hashedPassword', '$firstName', '$lastName', '$phone', '$address') 
            RETURNING id";
    
    $result = pg_query($conn, $sql);
    
    if ($result) {
        $row = pg_fetch_assoc($result);
        return [
            'success' => true,
            'message' => 'Registration successful',
            'customer_id' => $row['id']
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Registration failed: ' . pg_last_error($conn)
        ];
    }
}

/**
 * Authenticate customer login
 * @param string $email
 * @param string $password
 * @return array ['success' => bool, 'message' => string, 'customer' => array]
 */
function loginCustomer($email, $password) {
    $conn = get_connection();
    
    $email = pg_escape_string($conn, $email);
    $sql = "SELECT * FROM customers WHERE email = '$email'";
    $result = pg_query($conn, $sql);
    
    if (pg_num_rows($result) === 0) {
        return [
            'success' => false,
            'message' => 'Invalid email or password'
        ];
    }
    
    $customer = pg_fetch_assoc($result);
    
    if (password_verify($password, $customer['password'])) {
        // Remove password from return data
        unset($customer['password']);
        
        return [
            'success' => true,
            'message' => 'Login successful',
            'customer' => $customer
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Invalid email or password'
        ];
    }
}

/**
 * Get customer by ID
 * @param int $customerId
 * @return array|null
 */
function getCustomerById($customerId) {
    $conn = get_connection();
    
    $customerId = (int)$customerId;
    $sql = "SELECT id, email, first_name, last_name, phone, street_address, created_at 
            FROM customers WHERE id = $customerId";
    $result = pg_query($conn, $sql);
    
    if (pg_num_rows($result) > 0) {
        return pg_fetch_assoc($result);
    }
    
    return null;
}

/**
 * Get customer by email
 * @param string $email
 * @return array|null
 */
function getCustomerByEmail($email) {
    $conn = get_connection();
    
    $email = pg_escape_string($conn, $email);
    $sql = "SELECT id, email, first_name, last_name, phone, street_address, created_at 
            FROM customers WHERE email = '$email'";
    $result = pg_query($conn, $sql);
    
    if (pg_num_rows($result) > 0) {
        return pg_fetch_assoc($result);
    }
    
    return null;
}

/**
 * Update customer information
 * @param int $customerId
 * @param array $data
 * @return bool
 */
function updateCustomer($customerId, $data) {
    $conn = get_connection();
    
    $customerId = (int)$customerId;
    $updates = [];
    
    if (isset($data['first_name'])) {
        $firstName = pg_escape_string($conn, $data['first_name']);
        $updates[] = "first_name = '$firstName'";
    }
    
    if (isset($data['last_name'])) {
        $lastName = pg_escape_string($conn, $data['last_name']);
        $updates[] = "last_name = '$lastName'";
    }
    
    if (isset($data['phone'])) {
        $phone = pg_escape_string($conn, $data['phone']);
        $updates[] = "phone = '$phone'";
    }
    
    if (isset($data['street_address'])) {
        $address = pg_escape_string($conn, $data['street_address']);
        $updates[] = "street_address = '$address'";
    }
    
    if (empty($updates)) {
        return false;
    }
    
    $sql = "UPDATE customers SET " . implode(', ', $updates) . " WHERE id = $customerId";
    $result = pg_query($conn, $sql);
    
    return $result !== false;
}
?>
