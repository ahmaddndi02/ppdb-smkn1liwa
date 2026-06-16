<?php
// Koneksi Database InfinityFree
$host = 'sql103.infinityfree.com';
$dbname = 'if0_42174542_ppdb_smk';
$username = 'if0_42174542';
$password = 'jcyLOxSZUDHG';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>