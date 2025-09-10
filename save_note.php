<?php
// save_note.php - Save voice note to database
require_once 'protected_check.php';
header('Content-Type: application/json');

try {
    require_once 'config.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'] ?? 'Untitled Note';
        $content = $_POST['content'] ?? '';
        
        if (!empty($content)) {
            // Generate a session key based on the title (to group sessions)
            $session_key = md5($title);
            
            // Check if a note with this session key already exists
            $stmt = $pdo->prepare("SELECT id FROM voice_notes WHERE session_key = ? LIMIT 1");
            $stmt->execute([$session_key]);
            $existing = $stmt->fetch();
            
            if ($existing) {
                // Update existing session note
                $stmt = $pdo->prepare("UPDATE voice_notes SET title = ?, content = ?, updated_at = NOW() WHERE session_key = ?");
                $stmt->execute([$title, $content, $session_key]);
            } else {
                // Create new session note
                $stmt = $pdo->prepare("INSERT INTO voice_notes (title, content, session_key) VALUES (?, ?, ?)");
                $stmt->execute([$title, $content, $session_key]);
            }
            
            echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Content is required']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    }
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>