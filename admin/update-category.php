<?php
include 'config.php';
include('head.php'); 

function createSlug($string) {
    $slug = strtolower($string);
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
    $slug = preg_replace('/[\s-]+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

$message = '';
if (!isset($_GET['id'])) {
    die("ID not provided");
}
$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $slug = createSlug($name);

    $check = $conn->prepare("SELECT id FROM categories WHERE slug = ? AND id != ?");
    $check->bind_param("si", $slug, $id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $message = "Another category with this name exists.";
    } else {
        $stmt = $conn->prepare("UPDATE categories SET name = ?, slug = ?, updated_at = NOW() WHERE id = ?");
        $stmt->bind_param("ssi", $name, $slug, $id);
        if ($stmt->execute()) {
            $message = "Category updated successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
    }
}

$stmt = $conn->prepare("SELECT name FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Update Category</title>
    <style>
        /* Unique wrapper: no global effect */
        .cat-update-page {
            max-width: 600px;
            margin: 40px auto;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .cat-update-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .cat-update-title {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }
        .cat-update-form input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .cat-update-form input[type="text"]:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 6px rgba(13,110,253,0.3);
            outline: none;
        }
        .cat-update-btn {
            width: 100%;
            padding: 12px;
            background: #0d6efd;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s;
        }
        .cat-update-btn:hover {
            background: #0b5ed7;
        }
        .cat-back-btn {
            display: inline-block;
            margin-top: 15px;
            width: 100%;
            text-align: center;
            padding: 12px;
            background: #6c757d;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.3s;
        }
        .cat-back-btn:hover {
            background: #5a6268;
        }
        .cat-update-message {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 15px;
            text-align: center;
        }
        .cat-update-success {
            background-color: #e7f9ed;
            color: #1d643b;
            border: 1px solid #c3e6cb;
        }
        .cat-update-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        @media (max-width: 576px) {
            .cat-update-card {
                padding: 20px;
            }
            .cat-update-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

<div class="cat-update-page">
    <div class="cat-update-card">
        <h2 class="cat-update-title">Update Category</h2>

        <?php if ($message): ?>
            <div class="cat-update-message <?php echo (strpos($message, 'successfully') !== false) ? 'cat-update-success' : 'cat-update-error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="cat-update-form">
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <button type="submit" class="cat-update-btn">Update</button>
        </form>

        <!-- Back Button -->
        <a href="create-category.php" class="cat-back-btn">← Back to Categories</a>
    </div>
</div>

</body>
</html>
