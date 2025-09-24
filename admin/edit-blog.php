<?php
include 'config.php';
include 'head.php';

$id = $_GET['id'] ?? 0;
$message = '';

$stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();

if (!$blog) die("Blog not found.");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Safely get POST values, fall back to existing data to avoid undefined index
    $category_id       = $_POST['category_id'] ?? $blog['category_id'];
    $page_title        = $_POST['page_title'] ?? $blog['page_title'];
    $custom_slug       = $_POST['custom_slug'] ?? $blog['custom_slug'];
    $og_title          = $_POST['og_title'] ?? $blog['og_title'];
    $content           = $_POST['content'] ?? $blog['content'];

    // Existing images
    $og_image     = $blog['og_image'];
    $cover_image  = $blog['cover_image'];
    $banner_image = $blog['banner_image'];

    $upload_dir = '../uploads/';
    if (!file_exists($upload_dir)) mkdir($upload_dir, 0755, true);

    // Handle file uploads
    if (!empty($_FILES['og_image']['name'])) {
        $og_image = $upload_dir . time() . '_' . basename($_FILES['og_image']['name']);
        move_uploaded_file($_FILES['og_image']['tmp_name'], $og_image);
    }
    if (!empty($_FILES['cover_image']['name'])) {
        $cover_image = $upload_dir . time() . '_' . basename($_FILES['cover_image']['name']);
        move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image);
    }
    if (!empty($_FILES['banner_image']['name'])) {
        $banner_image = $upload_dir . time() . '_' . basename($_FILES['banner_image']['name']);
        move_uploaded_file($_FILES['banner_image']['tmp_name'], $banner_image);
    }

    // Update blog
    $stmt = $conn->prepare("UPDATE blogs SET category_id=?, page_title=?, custom_slug=?, og_title=?, og_image=?, cover_image=?, banner_image=?, content=?, updated_at=NOW() WHERE id=?");
    $stmt->bind_param("isssssssi", $category_id, $page_title, $custom_slug, $og_title, $og_image, $cover_image, $banner_image, $content, $id);

    if ($stmt->execute()) {
        $message = "Blog updated successfully"; // show success message on same page
        // Refresh blog data after update
        $stmt2 = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $blog = $stmt2->get_result()->fetch_assoc();
    } else {
        $message = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Blog</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background:#f5f5f5; font-family:'Segoe UI',sans-serif; }
.edit-blog-wrapper { max-width: 950px; margin: 40px auto; }
.edit-blog-card { background:#fff; border-radius:12px; padding:30px; box-shadow:0 6px 18px rgba(0,0,0,0.1); }
.edit-blog-card h2 { text-align:center; color:#0d6efd; margin-bottom:30px; }
.edit-blog-card label { font-weight:500; margin-top:12px; display:block; }
.edit-blog-card input, .edit-blog-card select, .edit-blog-card textarea { width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; }
.edit-blog-card textarea { min-height:120px; }
.edit-blog-card .btn { margin-top:20px; border-radius:6px; padding:12px 25px; font-weight:500; }
.image-preview { margin-top:8px; max-width:100px; max-height:75px; display:block; border-radius:4px; border:1px solid #ccc; }
.edit-blog-message { padding:12px; border-radius:6px; margin-bottom:15px; text-align:center; font-size:15px; }
.edit-blog-success { background-color:#e7f9ed; color:#1d643b; border:1px solid #c3e6cb; }
.edit-blog-error { background-color:#f8d7da; color:#721c24; border:1px solid #f5c6cb; }
@media(max-width:768px){ .edit-blog-card{padding:20px;} }
</style>
</head>
<body>
<div class="edit-blog-wrapper">
    <div class="edit-blog-card">
        <h2>Edit Blog</h2>

        <?php if($message): ?>
        <div class="edit-blog-message <?php echo strpos($message,'successfully')!==false?'edit-blog-success':'edit-blog-error'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <label>Category</label>
            <select name="category_id" required>
                <option value="">Select Category</option>
                <?php
                $cat_result = $conn->query("SELECT id, name FROM categories ORDER BY name ASC");
                while($cat = $cat_result->fetch_assoc()):
                    $sel = $cat['id']==$blog['category_id']?'selected':'';
                    echo "<option value='{$cat['id']}' $sel>".htmlspecialchars($cat['name'])."</option>";
                endwhile;
                ?>
            </select>

            <label>Page Title</label>
            <input type="text" name="page_title" value="<?php echo htmlspecialchars($blog['page_title']); ?>" required>

            <label>Custom Slug</label>
            <input type="text" name="custom_slug" value="<?php echo htmlspecialchars($blog['custom_slug']); ?>" required>

            <label>OG Title</label>
            <input type="text" name="og_title" value="<?php echo htmlspecialchars($blog['og_title']); ?>">

            <label>OG Image</label>
            <input type="file" name="og_image" accept="image/*" onchange="previewImage(event,'og_preview')">
            <img id="og_preview" class="image-preview" src="<?php echo $blog['og_image']?:''; ?>">

            <label>Cover Image</label>
            <input type="file" name="cover_image" accept="image/*" onchange="previewImage(event,'cover_preview')">
            <img id="cover_preview" class="image-preview" src="<?php echo $blog['cover_image']?:''; ?>">

            <label>Banner Image</label>
            <input type="file" name="banner_image" accept="image/*" onchange="previewImage(event,'banner_preview')">
            <img id="banner_preview" class="image-preview" src="<?php echo $blog['banner_image']?:''; ?>">

            <label>Content</label>
            <textarea name="content" required><?php echo htmlspecialchars($blog['content']); ?></textarea>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update Blog</button>
                <a href="blog-list.php" class="btn btn-secondary ms-3">Back</a>
            </div>
        </form>
    </div>
</div>

<script>
CKEDITOR.replace('content');
function previewImage(event, previewId){
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById(previewId);
        output.src = reader.result;
        output.style.display='block';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
