<?php
// get_notes.php - Retrieve all voice notes
require_once 'protected_check.php';
header('Content-Type: application/json');

try {
    require_once 'config.php';
    
    $stmt = $pdo->query("SELECT * FROM voice_notes ORDER BY created_at DESC");
    $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode(['success' => true, 'data' => $notes]);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>