<?php
$host = 'localhost';
$dbname = 'IOT';
$user = 'root';
$password = 'mellie27';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    // Enable exceptions for errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Database connection failed: " . $e->getMessage());
}
?>
