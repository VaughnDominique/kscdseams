<?php
require_once '../includes/db_email.php';
require_once '../includes/session.php'; // Assuming session handling is here

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender = $_SESSION['email'] ?? 'system@example.com'; // Get from session or default
    $recipient = $_POST['recipient'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    $attachment = null;

    // Handle file upload if present
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/emails/';
        
        // Create directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileName = time() . '_' . basename($_FILES['attachment']['name']);
        $uploadPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadPath)) {
            $attachment = $fileName;
        }
    }

    // Basic validation
    if (empty($recipient) || empty($subject) || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }

    // Try to send email (implementation depends on your mail system)
    // This is a placeholder for actual email sending logic
    $mailSent = mail($recipient, $subject, $message);
    $status = $mailSent ? 'sent' : 'failed';

    // Store the email in database regardless of sending success
    $emailId = storeEmail($sender, $recipient, $subject, $message, $attachment, $status);
    
    if ($emailId) {
        echo json_encode([
            'success' => true, 
            'message' => $mailSent ? 'Email sent and stored' : 'Email failed to send but was stored',
            'email_id' => $emailId
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to store email']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
