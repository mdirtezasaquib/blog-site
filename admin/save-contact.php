<?php
include 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email     = trim($_POST['email']);
    $subject   = trim($_POST['subject']);
    $message   = trim($_POST['message']);

    // Simple validation
    if ($full_name && $subject && $message && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (full_name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $full_name, $email, $subject, $message);

        if ($stmt->execute()) {
            echo "<script>alert('Message sent successfully!'); window.location.href='../contact.php';</script>";
        } else {
            echo "<script>alert('Database error. Try again.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Please fill all fields correctly.'); window.history.back();</script>";
    }
} else {
    echo "<script>window.location.href='index.php';</script>";
}
?>
