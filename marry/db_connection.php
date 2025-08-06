<?php
// db_connection.php

$host = 'localhost';
$db_name = 'marriage_bio_data';
$username = 'root';
$password = '';

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to sanitize input
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>