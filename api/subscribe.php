<?php
require_once __DIR__ . '/../helper/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!isset($data['endpoint'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid subscription data']);
    exit;
}

$endpoint = $data['endpoint'];
// Simpan keys (p256dh dan auth) sebagai JSON
$keysJson = isset($data['keys']) ? json_encode($data['keys']) : '{}';

try {
    // Insert on duplicate update (for sqlite we use INSERT OR REPLACE if endpoint is unique)
    $stmt = $db->prepare("INSERT OR REPLACE INTO subscriptions (endpoint, keys_json) VALUES (:endpoint, :keys)");
    $stmt->execute([
        ':endpoint' => $endpoint,
        ':keys' => $keysJson
    ]);
    
    echo json_encode(['success' => true, 'message' => 'Subscription saved']);
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error', 'details' => $e->getMessage()]);
}
