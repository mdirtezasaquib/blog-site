<?php
include 'config.php';
include 'head.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Blog List</title>
    <style>
        /* Wrapper to isolate CSS */
        .blog-list-page {
            max-width: 1000px;
            margin: 30px auto;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        .blog-list-page h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 25px;
            color: #333;
        }
        .blog-top-buttons {
            text-align: center;
            margin-bottom: 20px;
        }
        .blog-top-buttons a {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            text-decoration: none;
            background: #0d6efd;
            color: #fff;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s;
        }
        .blog-top-buttons a:hover {
            background: #0b5ed7;
        }
        .blog-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
            overflow-x: auto;
        }
        .blog-card table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }
        .blog-card th, .blog-card td {
            border: 1px solid #ddd;
            padding: 10px 12px;
            text-align: left;
            font-size: 14px;
        }
        .blog-card th {
            background-color: #f1f1f1;
            font-weight: 600;
        }
        .blog-actions button {
            margin-right: 5px;
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }
        .blog-update-btn {
            background: #28a745;
            color: #fff;
        }
        .blog-update-btn:hover {
            background: #218838;
        }
        .blog-delete-btn {
            background: #dc3545;
            color: #fff;
        }
        .blog-delete-btn:hover {
            background: #c82333;
        }
        .blog-actions a {
            color: #fff;
            text-decoration: none;
        }
        /* Responsive */
        @media (max-width: 768px) {
            .blog-card table, .blog-card th, .blog-card td {
                font-size: 13px;
            }
        }
        @media (max-width: 576px) {
            .blog-top-buttons a {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

<div class="blog-list-page">
    <h2>All Blogs</h2>

    <div class="blog-top-buttons">
        <a href="create-category.php">Add Category</a>
        <a href="create-blog.php">Add Blog</a>
    </div>

    <div class="blog-card">
        <table>
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Custom Slug</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>

            <?php
            $result = $conn->query("SELECT * FROM blogs ORDER BY id DESC");
            $count = 1;
            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo htmlspecialchars($row['page_title']); ?></td>
                <td><?php echo htmlspecialchars($row['custom_slug']); ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td><?php echo $row['updated_at']; ?></td>
                <td class="blog-actions">
                    <button class="blog-update-btn"><a href="edit-blog.php?id=<?php echo $row['id']; ?>">Update</a></button>
                    <button class="blog-delete-btn"><a href="delete-blog.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a></button>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>
