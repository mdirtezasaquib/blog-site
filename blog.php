<?php
include('base.php');
include('admin/config.php');
include('common/navbar.php');

// Selected Category
$selectedCategory = $_GET['category'] ?? '';

// Fetch Blogs
if($selectedCategory) {
    $stmt = $conn->prepare("SELECT b.*, c.name AS category_name, c.slug AS category_slug 
                            FROM blogs b 
                            JOIN categories c ON b.category_id = c.id 
                            WHERE c.slug = ? ORDER BY b.created_at DESC");
    $stmt->bind_param("s", $selectedCategory);
} else {
    $stmt = $conn->prepare("SELECT b.*, c.name AS category_name, c.slug AS category_slug 
                            FROM blogs b 
                            JOIN categories c ON b.category_id = c.id 
                            ORDER BY b.created_at DESC");
}
$stmt->execute();
$result = $stmt->get_result();
$categoryName = $selectedCategory ? $result->fetch_assoc()['category_name'] : "Our Blog Collection";
$stmt->execute(); // Re-execute since we fetched one row already
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Blogs - Gyaankosh</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

  <style>
    :root {
      --orange: #F37600;
      --black: #222;
      --gray: #777;
      --white: #fff;
      --transition: all 0.3s ease;
    }

    body { font-family: 'Poppins', sans-serif; padding-top: 80px; background: #f9f9f9; }

    .page-header { text-align: center; margin: 60px 0 20px; }
    .page-header h1 { font-size: 2.5rem; font-family: 'Playfair Display', serif; color: var(--orange); }

    .search-bar { text-align: center; margin-bottom: 30px; }
    .search-bar input { width: 300px; max-width: 90%; padding: 10px 15px; border: 1px solid #ccc; border-radius: 8px; font-size: 1rem; }

    /* Blogs Grid */
    .blogs-container { max-width: 1300px; margin: 0 auto; padding: 20px; }
    .blogs { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; }
    .card { background: var(--white); border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-decoration: none; color: inherit; display: flex; flex-direction: column; transition: var(--transition); }
    .card:hover { transform: translateY(-8px); }
    .card-img-container { height: 200px; overflow: hidden; }
    .card-img-container img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
    .card:hover img { transform: scale(1.1); }
    .card-content { padding: 18px; flex: 1; display: flex; flex-direction: column; }
    .card-category { background: var(--orange); color: var(--white); padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; margin-bottom: 10px; display: inline-block; }
    .card-content h3 { font-size: 1.4rem; font-family: 'Playfair Display', serif; margin-bottom: 10px; }
    .card-content p { flex: 1; font-size: 0.95rem; color: var(--gray); margin-bottom: 15px; }
    .meta { display: flex; justify-content: space-between; font-size: 0.85rem; color: var(--gray); border-top: 1px solid #eee; padding-top: 12px; }
    .read-more { color: var(--orange); font-weight: 500; text-decoration: none; transition: var(--transition); }
    .card:hover .read-more { color: #c55d00; }

    /* Responsive */
    @media(max-width: 1200px) { .blogs { grid-template-columns: repeat(3, 1fr); } }
    @media(max-width: 992px) { .blogs { grid-template-columns: repeat(2, 1fr); } }
    @media(max-width: 768px) { .blogs { grid-template-columns: 1fr; } }
  </style>
</head>
<body>

  <div class="page-header">
    <h1><?= htmlspecialchars($categoryName) ?></h1>
  </div>

  <div class="search-bar">
    <input type="text" id="blogSearch" placeholder="Search blogs...">
  </div>

  <div class="blogs-container">
    <div class="blogs" id="blogsGrid">
      <?php if($result->num_rows > 0): ?>
        <?php while($blog = $result->fetch_assoc()): ?>
          <a href="<?= $blog['category_slug'] ?>/<?= $blog['custom_slug'] ?>" class="card">
            <div class="card-img-container">
              <img src="uploads/<?= $blog['cover_image'] ?>" alt="<?= htmlspecialchars($blog['cover_image_alt']) ?>">
            </div>
            <div class="card-content">
              <span class="card-category"><?= htmlspecialchars($blog['category_name']) ?></span>
              <h3><?= htmlspecialchars($blog['page_title']) ?></h3>
              <p><?= substr(strip_tags($blog['cover_description']), 0, 100) ?>...</p>
              <div class="meta">
                <span><i class="fa-regular fa-calendar"></i> <?= date("d M Y", strtotime($blog['posted_on'])) ?></span>
                <span class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></span>
              </div>
            </div>
          </a>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No blogs found.</p>
      <?php endif; ?>
    </div>
  </div>

<script>
  // Live search
  const searchInput = document.getElementById('blogSearch');
  const blogCards = document.querySelectorAll('#blogsGrid .card');

  searchInput.addEventListener('input', function() {
    const query = this.value.toLowerCase();
    blogCards.forEach(card => {
      const text = card.textContent.toLowerCase();
      card.style.display = text.includes(query) ? 'block' : 'none';
    });
  });
</script>

</body>
</html>

<!-- Footer -->
<?php
include('common/footer.php');
?>
