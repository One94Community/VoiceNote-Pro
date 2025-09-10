<?php
// delete_note.php - Delete voice note
require_once 'protected_check.php';
header('Content-Type: application/json');

try {
    require_once 'config.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        
        if ($id > 0) {
            $stmt = $pdo->prepare("DELETE FROM voice_notes WHERE id = ?");
            $stmt->execute([$id]);
            
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid ID']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    }
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>