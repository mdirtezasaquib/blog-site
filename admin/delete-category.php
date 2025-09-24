<?php
include 'config.php';

if (!isset($_GET['id'])) {
    die("ID not provided");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    header("Location: create-category.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
?>
