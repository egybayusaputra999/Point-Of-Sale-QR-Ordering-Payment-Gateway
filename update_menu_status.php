<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=cafein', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Update menu status to available (status = 1)
    $stmt = $pdo->prepare("UPDATE menu SET status = 1 WHERE hapus IS NULL");
    $stmt->execute();
    
    echo "Updated " . $stmt->rowCount() . " menu items to available status.\n\n";
    
    // Show updated menu data
    $stmt = $pdo->query("SELECT id, nama, harga, jenis, status FROM menu WHERE hapus IS NULL ORDER BY jenis, id");
    $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Updated menu data:\n";
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
        echo "ID: {$menu['id']}, Nama: {$menu['nama']}, Harga: Rp {$menu['harga']}, Jenis: {$jenis_text}, Status: {$status_text}\n";
    }
    
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}
?>