<?php
// get_note.php - Get single note for editing
require_once 'protected_check.php';
header('Content-Type: application/json');

try {
    require_once 'config.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET['id'] ?? 0;
        
        if ($id > 0) {
            $stmt = $pdo->prepare("SELECT * FROM voice_notes WHERE id = ?");
            $stmt->execute([$id]);
            $note = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($note) {
                echo json_encode(['success' => true, 'data' => $note]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Note not found']);
            }
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