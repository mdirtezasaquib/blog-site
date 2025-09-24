<?php
include 'config.php';

$id = $_GET['id'] ?? 0;

if ($id) {
    // Optional: delete images from server
    $stmt = $conn->prepare("SELECT og_image, cover_image, banner_image FROM blogs WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    foreach(['og_image','cover_image','banner_image'] as $img){
        if(!empty($res[$img]) && file_exists($res[$img])){
            unlink($res[$img]);
        }
    }

    $stmt = $conn->prepare("DELETE FROM blogs WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
}

header("Location: blog-list.php?message=Blog deleted successfully");
exit;
?>
