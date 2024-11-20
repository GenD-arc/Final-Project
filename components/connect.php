<?php
// Securely load database credentials from environment variables or config file
$db_host = getenv('DB_HOST') ?: 'bgimxmvo8kfsiwhyfzd2-mysql.services.clever-cloud.com';
$db_name = getenv('DB_NAME') ?: 'bgimxmvo8kfsiwhyfzd2';
$db_user_name = getenv('DB_USERNAME') ?: 'unbnyunl7vpnfg91';
$db_user_pass = getenv('DB_PASSWORD') ?: 'ZYmoyRHKXDwz1icKnexa';

// Data Source Name (DSN) for PDO
$dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

try {
    // Create a new PDO connection
    $conn = new PDO($dsn, $db_user_name, $db_user_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
    echo "Database connection successful!";
} catch (PDOException $e) {
    // Log error to a file and show a user-friendly message
    error_log("Connection failed: " . $e->getMessage(), 3, '/path/to/error_log.log');
    echo "Connection failed. Please try again later.";
}

// Function to generate a unique ID
function create_unique_id() {
    return bin2hex(random_bytes(10)); // Generates a secure 20-character ID
}

?>
