<?php
// --- DATABASE CONNECTION ---
// This file connects your PHP application to your MySQL database.

// Database configuration
$host = 'localhost'; // Your database server, usually localhost
$db   = 'my_blog';    // The name of the database you created
$user = 'root';      // The default username for XAMPP
$pass = 'root';          // The default password for XAMPP is empty

// Data Source Name (DSN) - specifies the database type, host, and name.
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

// PDO options for error handling and fetching data
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use native prepared statements
];

// Try to connect to the database. If it fails, stop the script and show an error.
try {
    // Create a new PDO instance (the actual connection object)
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // If the connection fails, throw an exception with a clear error message.
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
