<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=cafein', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if menu table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'menu'");
    if ($stmt->rowCount() == 0) {
        echo "Table 'menu' does not exist.\n";
        exit;
    }
    
    // Count total menu items
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM menu WHERE hapus IS NULL");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Total menu items: " . $result['total'] . "\n\n";
    
    // Show sample menu data
    $stmt = $pdo->query("SELECT id, nama, harga, jenis, status FROM menu WHERE hapus IS NULL LIMIT 5");
    $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($menus) > 0) {
        echo "Sample menu data:\n";
        foreach ($menus as $menu) {
            $jenis_text = '';
            switch($menu['jenis']) {
                case 1: $jenis_text = 'Makanan'; break;
                case 2: $jenis_text = 'Snack'; break;
                case 3: $jenis_text = 'Minuman Dingin'; break;
                case 4: $jenis_text = 'Minuman Panas'; break;
                default: $jenis_text = 'Unknown';
            }
            $status_text = $menu['status'] == 1 ? 'Tersedia' : 'Habis';
            echo "ID: {$menu['id']}, Nama: {$menu['nama']}, Harga: {$menu['harga']}, Jenis: {$jenis_text}, Status: {$status_text}\n";
        }
    } else {
        echo "No menu data found.\n";
    }
    
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}
?>