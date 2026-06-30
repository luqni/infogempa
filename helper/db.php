<?php
$dbFile = '/var/www/data/database.sqlite';
$needsInit = !file_exists($dbFile);

try {
    $db = new PDO("sqlite:" . $dbFile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($needsInit) {
        // Buat tabel subscriptions untuk push notification
        $db->exec("CREATE TABLE IF NOT EXISTS subscriptions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            endpoint TEXT UNIQUE NOT NULL,
            keys_json TEXT NOT NULL
        )");
        
        // Buat tabel app_state untuk menyimpan status terakhir
        $db->exec("CREATE TABLE IF NOT EXISTS app_state (
            key TEXT PRIMARY KEY,
            value TEXT NOT NULL
        )");
        
        // Inisiasi waktu gempa
        $stmt = $db->prepare("INSERT INTO app_state (key, value) VALUES ('last_earthquake_time', 'initial')");
        $stmt->execute();
    }
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
