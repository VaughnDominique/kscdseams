<?php
require_once '../includes/db_email.php';
require_once '../includes/session.php'; // Assuming session handling is here

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $offset = ($page - 1) * $limit;
    
    $emails = getEmails($limit, $offset);
    
    echo json_encode([
        'success' => true,
        'data' => $emails,
        'page' => $page,
        'limit' => $limit
    ]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email_id'])) {
    // For retrieving a specific email
    $emailId = (int)$_POST['email_id'];
    $email = getEmailById($emailId);
    
    if ($email) {
        echo json_encode([
            'success' => true,
            'data' => $email
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Email not found'
        ]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
