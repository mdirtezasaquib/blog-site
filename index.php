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

  <style>
    /* Reset */
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Poppins', sans-serif;
      color: #fff;
    }

    /* Hero Section */
    .hero {
      position: relative;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      background: url('images/land.jpg') no-repeat center center/cover;
      overflow: hidden;
      
    }

    /* Gradient Overlay */
    .hero::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      animation: gradientMove 10s infinite alternate ease-in-out;
    
    }
    .hero-content {
      position: relative;
     
      max-width: 800px;
      padding: 20px;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      color : black;
    }

    .hero h1 span {
      background: linear-gradient(45deg, #00f260, #0575e6);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: 800;
    }

    .hero p {
      font-size: 1.2rem;
      margin-bottom: 30px;
      line-height: 1.6;
      color : gray;
    }

   
    .btn-primary-custom {
      background: linear-gradient(45deg, #00f260, #0575e6);
      border: none;
      color: #fff;
    }

    .btn-primary-custom:hover {
      background: linear-gradient(45deg, #0575e6, #00f260);
      transform: scale(1.05);
    }

    .btn-outline-custom {
      border: 2px solid #fff;
      color: #fff;
      background: transparent;
    }

    .btn-outline-custom:hover {
      background: #fff;
      color: #0575e6;
      transform: scale(1.05);
    }

    /* Email Form */
    .email-form {
      max-width: 500px;
      margin: 0 auto 30px auto;
      display: flex;
      gap: 10px;
     
    }

    .email-form input {
      flex: 1;
      padding: 12px 15px;
      border-radius: 50px;
      border: none;
      outline: none;
      font-size: 1rem;
       border : 1px solid black;
    }

    .email-form button {
      border-radius: 50px;
      padding: 12px 25px;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.2rem;
      }
      .hero p {
        font-size: 1rem;
      }
      .email-form {
        flex-direction: column;
      }
    }


    /* blog-index */

    .container { padding: 40px 16px; max-width: 1200px; }

/* Category heading */
.category-block { margin-bottom: 48px; padding: 28px; background: #fff; border-radius: 12px; box-shadow: 0 6px 20px rgba(19,24,31,0.04); }
.category-head { display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:18px; }
.category-head h2 { margin:0; font-size:22px; color:#0f1724; }
.category-head .cat-meta { color:#6b7280; font-size:14px; }

/* Big (featured) blog card */
.featured-card {
  display:flex;
  flex-direction:column;
  gap:14px;
  border-radius:12px;
  overflow:hidden;
  background: linear-gradient(180deg,#ffffff,#fcfdff);
  padding:16px;
  height:100%;
}
.featured-card .thumb { width:100%; height:320px; object-fit:cover; border-radius:8px; background:#eee; }
.featured-card .meta { display:flex; gap:8px; align-items:center; color:#6b7280; font-size:13px; }
.featured-card h3 { margin:0; font-size:20px; color:#0b1220; text-decoration: none !important; }
.featured-card p.lead { color:#374151; margin:6px 0 12px; }

/* Small cards list (right column) */
.small-list { display:flex; flex-direction:column; gap:12px; }
.small-card {
  display:flex;
  gap:12px;
  align-items:center;
  padding:10px;
  border-radius:10px;
  background:#fff;
  border:1px solid #f1f5f9;
  transition:transform .12s ease, box-shadow .12s ease;
}
.small-card:hover { transform:translateY(-4px); box-shadow:0 8px 24px rgba(16,24,40,0.06); }
.small-card img { width:88px; height:64px; object-fit:cover; border-radius:6px; flex-shrink:0; }
.small-card .s-info { flex:1; }
.small-card .s-info h4 { margin:0; font-size:15px; color:#0b1220; }
.small-card .s-info .date { font-size:13px; color:#6b7280; margin-top:6px; }

/* Read more button */
.btn-read {
  display:inline-flex;
  align-items:center;
  gap:8px;
  padding:8px 12px;
  border-radius:8px;
  border: none;
 background: linear-gradient(45deg, #00f260, #0575e6);
  color:#fff;
  font-weight:600;
  text-decoration:none;
  font-size:14px;
}
.btn-read i { font-size:12px; }
.small-grid { display:grid; grid-template-columns:repeat(2, 1fr); gap:12px; margin-top:14px; }
.small-grid .card { padding:10px; border-radius:10px; background:#fff; border:1px solid #f1f5f9; }


@media (max-width: 991px) {
  .featured-card .thumb { height:260px; }
}
@media (max-width: 767px) {
  .container { padding:24px 12px; }
  .featured-card .thumb { height:200px; }
  .small-card img { width:72px; height:52px; }
  .category-block { padding:18px; }
  .category-head h2 { font-size:18px; }
  .small-grid { grid-template-columns:repeat(1,1fr); }
}


a {
  text-decoration: none !important;
  color: inherit; 
}

a:hover {
  text-decoration: none !important;
  color: #0575e6; 
}
  </style>
</head>
<body>

<!-- Hero Section -->
<section class="hero">
  <div class="hero-content" data-aos="fade-up">
   <h1>Your <span>AI Powered</span><br> Blogging Partner</h1>
<p>Discover insightful blogs, trending topics, and expert opinions — all in one place. 
We bring you fresh, engaging, and SEO-friendly content to keep you informed and inspired.</p>


    <!-- Email Form -->
    <form class="email-form" action="#" method="post" data-aos="zoom-in">
      <input type="email" placeholder="Enter your work email" required>
      <button type="submit" class="btn btn-primary-custom">Get Free Proposal</button>
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
        <h2><?php echo e($catName); ?></h2>
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