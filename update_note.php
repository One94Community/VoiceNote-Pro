<?php
// update_note.php - Update existing voice note
require_once 'protected_check.php';
header('Content-Type: application/json');

try {
    require_once 'config.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        
        if ($id > 0 && !empty($content)) {
            $stmt = $pdo->prepare("UPDATE voice_notes SET title = ?, content = ? WHERE id = ?");
            $stmt->execute([$title, $content, $id]);
            
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    }
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>