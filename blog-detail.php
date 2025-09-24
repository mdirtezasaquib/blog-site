<?php
include 'admin/config.php';
include 'common/navbar.php';

$category_slug = $_GET['category'] ?? '';
$blog_slug = $_GET['slug'] ?? '';

$stmt = $conn->prepare("
    SELECT b.*, c.name AS category_name 
    FROM blogs b 
    JOIN categories c ON b.category_id = c.id 
    WHERE c.slug = ? AND b.custom_slug = ?
");
$stmt->bind_param("ss", $category_slug, $blog_slug);
$stmt->execute();
$result = $stmt->get_result();

if ($blog = $result->fetch_assoc()):
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo htmlspecialchars($blog['page_title']); ?></title>

  <!-- SEO Meta -->
  <meta name="description" content="<?php echo htmlspecialchars($blog['meta_description']); ?>">
  <meta name="keywords" content="<?php echo htmlspecialchars($blog['meta_keywords']); ?>">

  <!-- OG -->
  <meta property="og:title" content="<?php echo htmlspecialchars($blog['og_title']); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($blog['og_description']); ?>">
  <meta property="og:image" content="<?php echo $base_url . '/uploads/' . basename($blog['og_image']); ?>">
  <meta property="og:type" content="website">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo htmlspecialchars($blog['og_title']); ?>">
  <meta name="twitter:description" content="<?php echo htmlspecialchars($blog['og_description']); ?>">
  <meta name="twitter:image" content="<?php echo htmlspecialchars($blog['og_image']); ?>">

  <style>
    :root {
      --orange: #F37600;
      --orange-light: #FF9A40;
      --orange-dark: #D45A00;
      --black: #222222;
      --white: #FFFFFF;
      --gray-light: #F5F5F5;
      --gray: #777777;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: var(--white);
      color: var(--black);
      line-height: 1.7;
    }

    .banner {
      width: 100%;
      height: 60vh;
      overflow: hidden;
      position: relative;
    }
    
    .banner::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100px;
      background: linear-gradient(to top, var(--white), transparent);
      z-index: 1;
    }
    
    .banner img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      max-width: 1200px;
      margin: -80px auto 50px;
      padding: 0 20px;
      gap: 30px;
      position: relative;
      z-index: 2;
    }

    .content {
      flex: 1 1 65%;
      background: var(--white);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border-top: 5px solid var(--orange);
    }
    
    .content h1 {
      font-size: 32px;
      margin-bottom: 15px;
      color: var(--orange);
      position: relative;
      padding-bottom: 15px;
    }
    
    .content h1::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 4px;
      background: var(--orange);
      border-radius: 2px;
    }
    
    .meta {
      display: flex;
      align-items: center;
      gap: 20px;
      font-size: 15px;
      color: var(--gray);
      margin-bottom: 25px;
      padding: 15px;
      background: var(--gray-light);
      border-radius: 8px;
      border-left: 4px solid var(--orange);
    }
    
    .meta span {
      display: flex;
      align-items: center;
      gap: 5px;
    }
    
    .blog-body {
      font-size: 17px;
      color: var(--black);
    }
    
    .blog-body p {
      margin-bottom: 20px;
    }
    
    .blog-body h2 {
      color: var(--orange);
      margin: 30px 0 15px;
      font-size: 24px;
    }
    
    .blog-body h3 {
      color: var(--orange-dark);
      margin: 25px 0 15px;
      font-size: 20px;
    }
    
    .blog-body a {
      color: var(--orange);
      text-decoration: none;
      transition: all 0.3s;
    }
    
    .blog-body a:hover {
      color: var(--orange-dark);
      text-decoration: underline;
    }
    
    .blog-body blockquote {
      border-left: 4px solid var(--orange);
      padding-left: 20px;
      margin: 25px 0;
      font-style: italic;
      color: var(--gray);
    }
    
    .blog-body ul, .blog-body ol {
      padding-left: 20px;
      margin-bottom: 20px;
    }
    
    .blog-body li {
      margin-bottom: 8px;
    }

    .sidebar {
      flex: 1 1 30%;
    }
    
    .sidebar h3 {
      font-size: 22px;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 3px solid var(--orange);
      color: var(--black);
    }
    
    .recent-post {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      background: var(--white);
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      border-left: 3px solid transparent;
    }
    
    .recent-post:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(243, 118, 0, 0.15);
      border-left: 3px solid var(--orange);
    }
    
    .recent-post img {
      width: 80px;
      height: 70px;
      object-fit: cover;
      border-radius: 8px;
      margin-right: 15px;
    }
    
    .recent-post div {
      flex: 1;
    }
    
    .recent-post a {
      text-decoration: none;
      color: var(--black);
      font-weight: 600;
      display: block;
      margin-bottom: 5px;
      transition: all 0.3s;
      font-size: 16px;
    }
    
    .recent-post a:hover {
      color: var(--orange);
    }
    
    .recent-post small {
      color: var(--gray);
      font-size: 13px;
      display: block;
    }

    /* Responsive */
    @media(max-width: 992px) {
      .banner {
        height: 50vh;
      }
    }
    
    @media(max-width: 768px) {
      .container {
        flex-direction: column;
        margin-top: -50px;
      }
      
      .content, .sidebar {
        flex: 1 1 100%;
      }
      
      .content {
        padding: 25px;
      }
      
      .content h1 {
        font-size: 26px;
      }
      
      .meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
      
      .banner {
        height: 40vh;
      }
      
      .recent-post {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .recent-post img {
        width: 100%;
        height: 150px;
        margin-right: 0;
        margin-bottom: 12px;
      }
    }
    
    @media(max-width: 480px) {
      .content {
        padding: 20px;
      }
      
      .content h1 {
        font-size: 24px;
      }
      
      .banner {
        height: 35vh;
      }
    }
  </style>
</head>
<body>

  <!-- Full Width Banner -->
  <div class="banner">
    <?php if ($blog['banner_image']): ?>
      <img src="<?php echo htmlspecialchars($blog['banner_image']); ?>" alt="<?php echo htmlspecialchars($blog['banner_image_alt']); ?>">
    <?php endif; ?>
  </div>

  <!-- Main Container -->
  <div class="container">
    <!-- Blog Content -->
    <div class="content">
      <h1><?php echo htmlspecialchars($blog['custom_slug']); ?></h1>
      <div class="meta">
        <span>📂 <?php echo htmlspecialchars($blog['category_name']); ?></span>
        <span>🗓 <?php echo date('d M Y', strtotime($blog['posted_on'])); ?></span>
      </div>
      <div class="blog-body">
        <?php echo $blog['content']; ?>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <h3>Recent Posts</h3>
      <?php
      $recent = $conn->query("SELECT b.custom_slug, b.banner_image, b.banner_image_alt, b.posted_on, c.slug AS cat_slug, c.name AS category 
                              FROM blogs b 
                              JOIN categories c ON b.category_id = c.id 
                              ORDER BY b.posted_on DESC LIMIT 5");
      while($r = $recent->fetch_assoc()):
      ?>
        <div class="recent-post">
          <?php if ($r['banner_image']): ?>
            <img src="<?php echo htmlspecialchars($r['banner_image']); ?>" alt="<?php echo htmlspecialchars($r['banner_image_alt']); ?>">
          <?php endif; ?>
          <div>
            <a href="blog/<?php echo $r['cat_slug'].'/'.$r['custom_slug']; ?>">
              <?php echo htmlspecialchars($r['custom_slug']); ?>
            </a>
            <small><?php echo htmlspecialchars($r['category']); ?> | <?php echo date('d M Y', strtotime($r['posted_on'])); ?></small>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <!-- JSON-LD -->
  <?php
  $json_data = json_decode($blog['json_tag'], true);
  if($json_data !== null){
      $encoded_json = json_encode($json_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      ?>
      <script type="application/ld+json">
      <?php echo $encoded_json; ?>
      </script>
      <?php
  }
  ?>
</body>
</html>

<?php
else:
  echo "Blog not found.";
endif;
?>