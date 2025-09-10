<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    http_response_code(403); // Forbidden
    echo json_encode(['success' => false, 'message' => 'Access denied. Please log in.']);
    exit;
}
?>