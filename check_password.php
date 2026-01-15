<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=cafein', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT id, nama, password FROM user WHERE hapus IS NULL");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "User passwords:\n";
    foreach ($users as $user) {
        echo "ID: {$user['id']}, Name: {$user['nama']}\n";
        echo "Password hash: {$user['password']}\n";
        
        // Test common passwords
        $testPasswords = ['admin', 'password', '123456', 'pemilik', 'kasir', $user['nama']];
        foreach ($testPasswords as $testPass) {
            if (password_verify($testPass, $user['password'])) {
                echo "*** PASSWORD FOUND: '{$testPass}' ***\n";
                break;
            }
        }
        echo "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>