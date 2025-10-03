<?php
include('common/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Page Title -->
  <title>Home | Blog</title>

  <!-- Meta Description & Keywords -->
  <meta name="description" content="Read the latest blogs, tutorials, and articles on technology, lifestyle, and more.">
  <meta name="keywords" content="blog, articles, tutorials, technology, lifestyle, tips">

  <!-- Canonical URL -->
  <link rel="canonical" href="https://www.example.com/">

  <!-- Favicon -->
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

  <!-- Open Graph -->
  <meta property="og:title" content="Home | Blog">
  <meta property="og:description" content="Read the latest blogs, tutorials, and articles on technology, lifestyle, and more.">
  <meta property="og:image" content="https://www.example.com/images/og-default.jpg">
  <meta property="og:url" content="https://www.example.com/">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Blog">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Home | Blog">
  <meta name="twitter:description" content="Read the latest blogs, tutorials, and articles on technology, lifestyle, and more.">
  <meta name="twitter:image" content="https://www.example.com/images/og-default.jpg">

  <!-- Schema / JSON-LD -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Home | Blog",
    "url": "https://www.example.com/",
    "description": "Read the latest blogs, tutorials, and articles on technology, lifestyle, and more."
  }
  </script>

  <!-- CSS Libraries -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/index.css">
</head>
<body>

<!-- Hero Section -->
<section class="hero">
  <div class="hero-content" data-aos="fade-up">
   <h1>Your <span>AI Powered</span><br> Blogging Partner</h1>
<p>Discover insightful blogs, trending topics, and expert opinions — all in one place. 
We bring you fresh, engaging, and SEO-friendly content to keep you informed and inspired.</p>


    <form class="email-form" action="admin/save-email.php" method="post" data-aos="zoom-in">
  <input type="email" name="email" placeholder="Enter your work email" required>
  <button type="submit" class="btn btn-primary-custom">Subscribe Newsletter</button>
</form>


   
  </div>
</section>






<!--  dynamic blog section -->
<?php


define('COVER_PATH', 'uploads/');

include 'admin/config.php';

// Helper to safely print
function e($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

$catSql = "
    SELECT c.id, c.name, c.slug
    FROM categories c
    JOIN blogs b ON b.category_id = c.id
    GROUP BY c.id
    ORDER BY c.name ASC
";
$catResult = $conn->query($catSql);
?>


<div class="container">
 
<?php
if (!$catResult || $catResult->num_rows === 0) {
    echo '<p>No categories found.</p>';
} else {
    while ($cat = $catResult->fetch_assoc()) {
        $catId = (int)$cat['id'];
        $catName = $cat['name'];
        $catSlug = $cat['slug'];


       $stmt = $conn->prepare("
    SELECT b.id, b.custom_slug, b.cover_image, b.cover_image_alt, b.cover_title, 
           b.cover_description, b.page_title, b.posted_on, c.slug AS category_slug
    FROM blogs b
    JOIN categories c ON b.category_id = c.id
    WHERE b.category_id = ?
    ORDER BY b.posted_on DESC 
    LIMIT 1
");

        $stmt->bind_param("i", $catId);
        $stmt->execute();
        $featured = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if (!$featured) {
            
            continue;
        }

        
       $stmt2 = $conn->prepare("
    SELECT b.id, b.custom_slug, b.cover_image, b.cover_image_alt, b.cover_title, 
           b.posted_on, c.slug AS category_slug
    FROM blogs b
    JOIN categories c ON b.category_id = c.id
    WHERE b.category_id = ?
    ORDER BY b.posted_on DESC 
    LIMIT 10 OFFSET 1
");

        $stmt2->bind_param("i", $catId);
        $stmt2->execute();
        $others = $stmt2->get_result();
        $stmt2->close();

        // Count of other posts
        $otherCount = $others ? $others->num_rows : 0;
?>
  <section class="category-block">
    <div class="category-head">
      <div>
       <h2>
  <a href="<?= e($catSlug) ?>" style="text-decoration:none; color:#000;">
    <?= e($catName) ?>
  </a>
</h2>
        <div class="cat-meta"><?php echo $otherCount + 1; ?> Posts Total</div>
      </div>
      
    </div>

    <div class="row g-4 align-items-start">
      <!-- Featured (left / top on small screens) -->
      <div class="col-12 col-lg-7">
        <article class="featured-card">
          <?php
            $fCover = $featured['cover_image'] ? COVER_PATH . $featured['cover_image'] : 'https://via.placeholder.com/900x520?text=No+Image';
            $fAlt = $featured['cover_image_alt'] ?: $featured['cover_title'] ?: 'cover image';
          ?>
          <a href="<?php echo e($featured['category_slug']); ?>/<?php echo e($featured['custom_slug']); ?>">

            <img class="thumb" src="<?php echo e($fCover); ?>" alt="<?php echo e($fAlt); ?>">
          </a>
          <div>
            <div class="meta">
              <small class="text-uppercase" style="letter-spacing:0.6px; font-weight:600; color:#6b7280;"><?php echo e($catName); ?></small>
              <small>•</small>
              <small><?php echo date('M j, Y', strtotime($featured['posted_on'])); ?></small>
            </div>

           <h3>
  <a href="<?php echo e($featured['category_slug']); ?>/<?php echo e($featured['custom_slug']); ?>">
    <?php echo e($featured['cover_title'] ?: $featured['page_title']); ?>
  </a>
</h3>


            <?php if (!empty($featured['cover_description'])): ?>
              <p class="lead"><?php echo e(mb_strimwidth($featured['cover_description'], 0, 180, '...')); ?></p>
            <?php endif; ?>

            <a class="btn-read" href="<?php echo e($featured['category_slug']); ?>/<?php echo e($featured['custom_slug']); ?>">
  Read article <i class="fa-solid fa-arrow-right"></i>
</a>

             
          
          </div>
        </article>
      </div>

      <!-- Other small posts (right column on large screens) -->
      <div class="col-12 col-lg-5">
        <div class="small-list">
          <?php
            if ($otherCount > 0) {
                while ($o = $others->fetch_assoc()) {
                    $sCover = $o['cover_image'] ? COVER_PATH . $o['cover_image'] : 'https://via.placeholder.com/400x300?text=No+Image';
          ?>
           <a class="small-card" href="<?php echo e($o['category_slug']); ?>/<?php echo e($o['custom_slug']); ?>">
  <img src="<?php echo e($sCover); ?>" alt="<?php echo e($o['cover_image_alt'] ?: $o['cover_title']); ?>">
  <div class="s-info">
    <h4><?php echo e(mb_strimwidth($o['cover_title'] ?: 'Untitled', 0, 60, '...')); ?></h4>
    <div class="date"><?php echo date('M j, Y', strtotime($o['posted_on'])); ?></div>
  </div>
  <div class="d-none d-md-block text-end">
    <span class="badge bg-light text-dark" style="font-weight:600;">Read More</span>
  </div>
</a>

          <?php
                } 
            } else {
                echo '<div class="text-muted">No more posts in this category.</div>';
            }
          ?>
        </div>

      
      </div>
    </div>
  </section>

<?php
    } 
} 
?>
</div> 





<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true
  });
</script>
</body>
</html>
<?php
include('common/footer.php');
?>