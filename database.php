<?php 

try {
    $db = new PDO("mysql:host=localhost;dbname=staff login", "root", ""); // Corrected the DSN format
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected";
} catch (Exception $e) {
    echo "Could not connect to the database: " . $e->getMessage();
    exit;
}
