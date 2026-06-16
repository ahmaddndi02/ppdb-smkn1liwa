<?php
require_once 'config/database.php';

// Hapus semua admin yang ada
$pdo->exec("DELETE FROM admin");

// Buat password baru
$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert admin baru
$stmt = $pdo->prepare("INSERT INTO admin (username, password, nama_lengkap, email, level) VALUES (?, ?, ?, ?, ?)");
$stmt->execute(['admin', $hashed_password, 'Administrator', 'admin@smkn1liwa.sch.id', 'super_admin']);

echo "<h2>✅ Admin berhasil direset!</h2>";
echo "<p><strong>Username:</strong> admin</p>";
echo "<p><strong>Password:</strong> admin123</p>";
echo "<a href='admin_login.php'>Klik disini untuk login</a>";
?>