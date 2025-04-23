<?php
require_once 'db_connect.php';

function createEmailTable() {
    global $conn;
    $sql = "CREATE TABLE IF NOT EXISTS emails (
        id INT AUTO_INCREMENT PRIMARY KEY,
        sender VARCHAR(255) NOT NULL,
        recipient VARCHAR(255) NOT NULL,
        subject VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        attachment VARCHAR(255),
        sent_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        status ENUM('sent', 'draft', 'failed') NOT NULL
    )";
    
    if ($conn->query($sql) === FALSE) {
        die("Error creating emails table: " . $conn->error);
    }
}

function storeEmail($sender, $recipient, $subject, $message, $attachment = null, $status = 'sent') {
    global $conn;
    
    $sql = "INSERT INTO emails (sender, recipient, subject, message, attachment, status) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $sender, $recipient, $subject, $message, $attachment, $status);
    
    if ($stmt->execute()) {
        return $conn->insert_id;
    } else {
        return false;
    }
}

function getEmails($limit = 10, $offset = 0) {
    global $conn;
    
    $sql = "SELECT * FROM emails ORDER BY sent_date DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $emails = [];
    
    while ($row = $result->fetch_assoc()) {
        $emails[] = $row;
    }
    
    return $emails;
}

function getEmailById($id) {
    global $conn;
    
    $sql = "SELECT * FROM emails WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Initialize the email table
createEmailTable();
?>
