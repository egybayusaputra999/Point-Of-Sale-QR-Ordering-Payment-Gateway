<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=cafein', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT id, nama, rule FROM user WHERE hapus IS NULL");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Available users:\n";
    foreach ($users as $user) {
        echo "ID: {$user['id']}, Name: {$user['nama']}, Role: {$user['rule']}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>