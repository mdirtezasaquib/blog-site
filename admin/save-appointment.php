<?php
include('config.php');

// Agar form submit hua ho
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $visited = $conn->real_escape_string($_POST['visited']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO appointments (name, email, phone, visited, subject, message) VALUES ('$name', '$email', '$phone', '$visited', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Appointment submitted successfully!'); window.location.href='../index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='../index.php';</script>";
    }
}

$conn->close();
?>
