<?php
include 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email'])) {
    $email = trim($_POST['email']);

    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        $stmt = $conn->prepare("INSERT INTO emails (email) VALUES (?)");
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
    
            echo "<script>alert('Email saved successfully!'); window.location.href='../index.php';</script>";
        } else {
            echo "<script>alert('Database error. Try again.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Please enter a valid email'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Email cannot be empty'); window.history.back();</script>";
}
?>
