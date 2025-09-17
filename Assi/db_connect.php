<?php
// --- DATABASE CREDENTIALS ---
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); // Default username for XAMPP is 'root'
define('DB_PASSWORD', 'root');     // Default password for XAMPP is empty
define('DB_NAME', 'whack_a_mole_db2'); // CHANGE THIS

// --- ATTEMPT TO CONNECT TO MYSQL DATABASE ---
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
