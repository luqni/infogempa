<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../helper/db.php';

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

$xmlUrl = "https://data.bmkg.go.id/DataMKG/TEWS/autogempa.xml";
$xmlData = @simplexml_load_file($xmlUrl);

if ($xmlData === false) {
    die("Failed to fetch BMKG data.\n");
}

$gempa = $xmlData->gempa;
$waktu = (string)$gempa->DateTime;
$mag = (string)$gempa->Magnitude;
$wilayah = (string)$gempa->Wilayah;

// Get last earthquake time from DB
$stmt = $db->query("SELECT value FROM app_state WHERE key = 'last_earthquake_time'");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$lastTime = $row ? $row['value'] : 'initial';

if ($waktu !== $lastTime) {
    echo "New earthquake detected! Broadcasting Push Notifications...\n";
    
    // Update last earthquake time in DB
    $stmt = $db->prepare("UPDATE app_state SET value = :val WHERE key = 'last_earthquake_time'");
    $stmt->execute([':val' => $waktu]);
    
    // Load VAPID keys
    $vapidJson = file_get_contents(__DIR__ . '/../api/vapid_keys.json');
    $vapidKeys = json_decode($vapidJson, true);
    
    $auth = [
        'VAPID' => [
            'subject' => 'mailto:admin@infogempa.local', 
            'publicKey' => $vapidKeys['publicKey'],
            'privateKey' => $vapidKeys['privateKey'],
        ],
    ];
    
    $webPush = new WebPush($auth);
    
    // Fetch all subscriptions
    $stmt = $db->query("SELECT * FROM subscriptions");
    $subscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $payload = json_encode([
        'title' => "Peringatan Dini Gempa M$mag",
        'body' => "Telah terjadi gempa pada $waktu di wilayah $wilayah.",
        'icon' => 'assets/icon-192.png',
        'url' => '/'
    ]);
    
    foreach ($subscriptions as $subRow) {
        $endpoint = $subRow['endpoint'];
        $keys = json_decode($subRow['keys_json'], true);
        
        $subscription = Subscription::create([
            'endpoint' => $endpoint,
            'publicKey' => $keys['p256dh'] ?? '',
            'authToken' => $keys['auth'] ?? '',
        ]);
        
        $webPush->queueNotification($subscription, $payload);
    }
    
    // Send all queued notifications
    foreach ($webPush->flush() as $report) {
        $endpoint = $report->getRequest()->getUri()->__toString();
        if ($report->isSuccess()) {
            echo "[v] Message sent successfully for {$endpoint}.\n";
        } else {
            echo "[x] Message failed to sent for {$endpoint}: {$report->getReason()}\n";
            // If the subscription is expired or unsubscribed, remove it from DB
            if ($report->isSubscriptionExpired()) {
                $stmt = $db->prepare("DELETE FROM subscriptions WHERE endpoint = :endpoint");
                $stmt->execute([':endpoint' => $endpoint]);
                echo "[-] Removed expired endpoint from database.\n";
            }
        }
    }
} else {
    echo "No new earthquake data. (Last: $lastTime)\n";
}
