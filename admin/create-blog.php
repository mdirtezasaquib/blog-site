<?php
include 'config.php';
include 'head.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $page_title = $_POST['page_title'];
    $google_tag = $_POST['google_tag'];
    $json_tag = $_POST['json_tag'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $canonical_url = $_POST['canonical_url'];
    $custom_slug = $_POST['custom_slug'];
    $og_title = $_POST['og_title'];
    $og_image_alt = $_POST['og_image_alt'];
    $og_url = $_POST['og_url'];
    $og_description = $_POST['og_description'];
    $cover_image_alt = $_POST['cover_image_alt'];
    $cover_title = $_POST['cover_title'];
    $cover_description = $_POST['cover_description'];
    $posted_on = $_POST['posted_on'];
    $banner_image_alt = $_POST['banner_image_alt'];
    $content = $_POST['content'];

    // Handle file uploads
    $og_image = $cover_image = $banner_image = '';
    $upload_dir = '../uploads/';
    if (!file_exists($upload_dir)) mkdir($upload_dir, 0755, true);

    if (!empty($_FILES['og_image']['name'])) {
        $og_image = $upload_dir.time().'_'.basename($_FILES['og_image']['name']);
        move_uploaded_file($_FILES['og_image']['tmp_name'],$og_image);
    }
    if (!empty($_FILES['cover_image']['name'])) {
        $cover_image = $upload_dir.time().'_'.basename($_FILES['cover_image']['name']);
        move_uploaded_file($_FILES['cover_image']['tmp_name'],$cover_image);
    }
    if (!empty($_FILES['banner_image']['name'])) {
        $banner_image = $upload_dir.time().'_'.basename($_FILES['banner_image']['name']);
        move_uploaded_file($_FILES['banner_image']['tmp_name'],$banner_image);
    }

    // Check slug
    $check = $conn->prepare("SELECT id FROM blogs WHERE custom_slug=?");
    $check->bind_param("s", $custom_slug);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $message = "Blog slug already exists.";
    } else {
        $stmt = $conn->prepare("INSERT INTO blogs (category_id, page_title, google_tag, json_tag, meta_description, meta_keywords, canonical_url, custom_slug, og_title, og_image, og_image_alt, og_url, og_description, cover_image, cover_image_alt, cover_title, cover_description, posted_on, banner_image, banner_image_alt, content, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("issssssssssssssssssss", $category_id, $page_title, $google_tag, $json_tag, $meta_description, $meta_keywords, $canonical_url, $custom_slug, $og_title, $og_image, $og_image_alt, $og_url, $og_description, $cover_image, $cover_image_alt, $cover_title, $cover_description, $posted_on, $banner_image, $banner_image_alt, $content);
        if($stmt->execute()) $message = "Blog created successfully."; else $message = "Error: ".$stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Blog</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
/* Isolated styles for Create Blog page */
.create-blog-wrapper { max-width: 950px; margin: 30px auto; font-family: 'Segoe UI', sans-serif; }
.create-blog-card { background: #fff; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.1); padding: 30px; }
.create-blog-card h2 { text-align: center; color: #0d6efd; margin-bottom: 25px; }
.create-blog-card label { font-weight: 500; margin-top: 12px; }
.create-blog-card input, .create-blog-card select, .create-blog-card textarea { border-radius: 6px; border:1px solid #ccc; padding:10px; width:100%; }
.create-blog-card button { margin-top: 20px; padding: 12px 25px; border-radius: 6px; font-size:16px; font-weight:500; }
.create-blog-card .btn-primary { background: #0d6efd; color: #fff; border: none; transition:0.3s; }
.create-blog-card .btn-primary:hover { background:#0b5ed7; }
.create-blog-card .btn-secondary { background: #6c757d; color:#fff; border:none; transition:0.3s; }
.create-blog-card .btn-secondary:hover { background:#5c636a; }
.create-blog-message { padding: 12px; border-radius: 6px; margin-bottom: 15px; font-size:15px; text-align:center; }
.create-blog-success { background-color: #e7f9ed; color: #1d643b; border:1px solid #c3e6cb; }
.create-blog-error { background-color: #f8d7da; color:#721c24; border:1px solid #f5c6cb; }
.image-preview { margin-top: 10px; max-width:200px; max-height:150px; display:none; }
@media(max-width:768px){ .create-blog-card{padding:20px;} }
</style>
</head>
<body>
<div class="create-blog-wrapper">
    <div class="create-blog-card">
        <h2>Create Blog</h2>

        <?php if(!empty($message)): ?>
            <div class="create-blog-message <?php echo strpos($message,'successfully')!==false ? 'create-blog-success':'create-blog-error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <label>Category</label>
            <select name="category_id" required>
                <option value="">Select Category</option>
                <?php
                $result = $conn->query("SELECT id, name FROM categories ORDER BY name ASC");
                while($row=$result->fetch_assoc()) echo "<option value='{$row['id']}'>".htmlspecialchars($row['name'])."</option>";
                ?>
            </select>

            <label>Page Title</label><input type="text" name="page_title" required>
            <label>Google Tag</label><textarea name="google_tag"></textarea>
            <label>JSON Tag</label><textarea name="json_tag"></textarea>
            <label>Meta Description</label><textarea name="meta_description"></textarea>
            <label>Meta Keywords</label><textarea name="meta_keywords"></textarea>
            <label>Canonical URL</label><input type="text" name="canonical_url">
            <label>Custom Slug</label><input type="text" name="custom_slug" required>

            <label>OG Title</label><input type="text" name="og_title">
            <label>OG Image</label><input type="file" name="og_image" accept="image/*" onchange="previewImage(event,'og_preview')">
            <img id="og_preview" class="image-preview">
            <label>OG Image Alt</label><input type="text" name="og_image_alt">
            <label>OG URL</label><input type="text" name="og_url">
            <label>OG Description</label><textarea name="og_description"></textarea>

            <label>Cover Image</label><input type="file" name="cover_image" accept="image/*" onchange="previewImage(event,'cover_preview')">
            <img id="cover_preview" class="image-preview">
            <label>Cover Image Alt</label><input type="text" name="cover_image_alt">
            <label>Cover Title</label><input type="text" name="cover_title">
            <label>Cover Description</label><textarea name="cover_description"></textarea>
            <label>Posted On</label><input type="datetime-local" name="posted_on">

            <label>Banner Image</label><input type="file" name="banner_image" accept="image/*" onchange="previewImage(event,'banner_preview')">
            <img id="banner_preview" class="image-preview">
            <label>Banner Image Alt</label><input type="text" name="banner_image_alt">

            <label>Content</label><textarea name="content" required></textarea>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Create Blog</button>
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
