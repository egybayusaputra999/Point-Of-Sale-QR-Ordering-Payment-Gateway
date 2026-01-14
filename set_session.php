<?php
session_start();

// Set session untuk user Pemilik
$_SESSION['nama'] = 'Pemilik';
$_SESSION['rule'] = '1';
$_SESSION['id'] = '6';

echo "Session set successfully!\n";
echo "nama: " . $_SESSION['nama'] . "\n";
echo "rule: " . $_SESSION['rule'] . "\n";
echo "id: " . $_SESSION['id'] . "\n";
echo "\nNow you can access /antrian page\n";
?>