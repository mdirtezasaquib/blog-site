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
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $name = trim($_POST['name']);
    $slug = createSlug($name);

    $check = $conn->prepare("SELECT id FROM categories WHERE slug = ?");
    $check->bind_param("s", $slug);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $message = "Category already exists.";
    } else {
        $stmt = $conn->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $slug);
        if ($stmt->execute()) {
            $message = "Category created successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Create Category</title>
<style>
/* ---------- UNIQUE CATEGORY PAGE STYLES ---------- */
.cat-page {
  max-width: 1000px;
  margin: 30px auto;
  padding: 0 16px;
  font-family: "Segoe UI", Arial, sans-serif;
}
.cat-title {
  text-align: center;
  font-size: 24px;
  margin-bottom: 20px;
  color: #222;
}
.cat-message {
  padding: 12px;
  background-color: #e7f3e7;
  color: #2c662d;
  border: 1px solid #c3e6cb;
  border-radius: 6px;
  margin-bottom: 20px;
}
.cat-form {
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 3px 12px rgba(0,0,0,0.05);
  margin-bottom: 30px;
}
.cat-form input[type="text"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 12px;
  border-radius: 6px;
  border: 1px solid #ccc;
  font-size: 15px;
}
.cat-form button {
  padding: 10px 20px;
  border: none;
  background: #2563eb;
  color: white;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
}
.cat-form button:hover {
  background: #1e4ed8;
}
.cat-table {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  box-shadow: 0 3px 12px rgba(0,0,0,0.05);
  border-radius: 10px;
  overflow: hidden;
}
.cat-table th, .cat-table td {
  padding: 12px;
  border-bottom: 1px solid #eee;
  text-align: left;
}
.cat-table th {
  background: #f9fafb;
  font-weight: 600;
}
.cat-actions {
  display: flex;
  gap: 8px;
}
.cat-btn {
  display: inline-block;
  padding: 6px 12px;
  font-size: 14px;
  border-radius: 6px;
  text-decoration: none;
  color: #fff;
}
.cat-btn-update { background: #2563eb; }
.cat-btn-update:hover { background: #1e4ed8; }
.cat-btn-delete { background: #dc2626; }
.cat-btn-delete:hover { background: #b91c1c; }

/* ---------- RESPONSIVE ---------- */
@media (max-width: 600px) {
  .cat-title { font-size: 20px; }
  .cat-table th, .cat-table td { padding: 10px; font-size: 14px; }
  .cat-form { padding: 16px; }
}
</style>
</head>
<body>

<div class="cat-page">

  <h2 class="cat-title">Create Category</h2>

  <?php if ($message): ?>
    <div class="cat-message"><?php echo htmlspecialchars($message); ?></div>
  <?php endif; ?>

  <form class="cat-form" method="POST">
    <input type="text" name="name" placeholder="Category Name" required>
    <button type="submit">Add Category</button>
  </form>

  <h2 class="cat-title">All Categories</h2>

  <table class="cat-table">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Slug</th>
      <th>Actions</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM categories ORDER BY id DESC");
    while ($row = $result->fetch_assoc()):
    ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo htmlspecialchars($row['name']); ?></td>
      <td><?php echo htmlspecialchars($row['slug']); ?></td>
      <td>
        <div class="cat-actions">
          <a class="cat-btn cat-btn-update" href="update-category.php?id=<?php echo $row['id']; ?>">Update</a>
          <a class="cat-btn cat-btn-delete" href="delete-category.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
        </div>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>

</div>

</body>
</html>
