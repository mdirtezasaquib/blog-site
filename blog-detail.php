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

  <!-- Google Tag (hidden on screen, visible in source code) -->
  <style>.google-tag { display: none; }</style>
  <div class="google-tag">
      <?= $blog['google_tag']; ?>
  </div>

  <!-- canonical  -->
  <link rel="canonical" href="/blog/<?php echo htmlspecialchars($blog['custom_slug']); ?>">

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

  <!-- Font Awesome for Social Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

    .banner-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .banner {
      width: 100%;
      height: 400px;
      overflow: hidden;
      position: relative;
      margin-top: 30px;
    }
    
    .banner img {
      margin-top: 7vh !important;
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      max-width: 1200px;
      margin: 30px auto 50px;
      padding: 0 20px;
      gap: 30px;
      position: relative;
    }

    .content {
      flex: 1 1 65%;
      background: var(--white);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border-top: 5px solid var(--orange);
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
      position: sticky;
      top: 20px;
      height: fit-content;
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

    /* Social Sharing Styles */
    .social-sharing {
      margin-top: 40px;
      padding-top: 30px;
      border-top: 1px solid #eee;
    }
    
    .social-sharing h4 {
      font-size: 18px;
      margin-bottom: 15px;
      color: var(--black);
      text-align: center;
    }
    
    .social-icons {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 12px;
    }
    
    .social-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      color: var(--black);
      font-size: 20px;
      transition: all 0.3s ease;
      text-decoration: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background: var(--white);
      border: 1px solid #e0e0e0;
      position: relative;
    }
    
    .social-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
      color: var(--white);
    }
    
    .facebook:hover { background: #3b5998; }
    .twitter:hover { background: #1da1f2; }
    .linkedin:hover { background: #0077b5; }
    .pinterest:hover { background: #bd081c; }
    .instagram:hover { 
      background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
    }
    .whatsapp:hover { background: #25D366; }
    .copy-link:hover { background: var(--orange); }
    
    .copy-message {
      position: absolute;
      bottom: -35px;
      left: 50%;
      transform: translateX(-50%);
      background: var(--black);
      color: var(--white);
      padding: 5px 10px;
      border-radius: 4px;
      font-size: 12px;
      white-space: nowrap;
      opacity: 0;
      transition: opacity 0.3s;
      pointer-events: none;
    }
    
    .copy-message.show {
      opacity: 1;
    }
    
    .share-text {
      margin-top: 15px;
      text-align: center;
      font-size: 14px;
      color: var(--gray);
    }

    /* Responsive */
    @media(max-width: 992px) {
      .banner {
        height: 350px;
      }
    }
    
    @media(max-width: 768px) {
      .container {
        flex-direction: column;
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
        height: 300px;
        margin-top: 20px;
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
      
      .sidebar {
        position: static;
      }
      
      .social-btn {
        width: 45px;
        height: 45px;
        font-size: 18px;
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
        height: 250px;
      }
      
      .social-btn {
        width: 40px;
        height: 40px;
        font-size: 16px;
      }
      
      .social-icons {
        gap: 8px;
      }
    }
  </style>
</head>
<body>

  <!-- Banner Container -->
  <div class="banner-container">
    <div class="banner">
      <?php if ($blog['banner_image']): ?>
        <img src="<?php echo htmlspecialchars($blog['banner_image']); ?>" alt="<?php echo htmlspecialchars($blog['banner_image_alt']); ?>">
      <?php endif; ?>
    </div>
  </div>

  <!-- Main Container -->
  <div class="container">
    <!-- Blog Content -->
    <div class="content">
      <div class="meta">
        <span>📂 <?php echo htmlspecialchars($blog['category_name']); ?></span>
        <span>🗓 <?php echo date('d M Y', strtotime($blog['posted_on'])); ?></span>
      </div>
      <div class="blog-body">
        <?php echo $blog['content']; ?>
      </div>
      
      <!-- Social Media Sharing -->
      <div class="social-sharing">
        <h4>Share this post</h4>
        <div class="social-icons">
          <?php
          $current_url = urlencode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
          $title = urlencode($blog['page_title']);
          $description = urlencode(strip_tags($blog['content']));
          ?>
          
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_url; ?>" target="_blank" class="social-btn facebook">
            <i class="fab fa-facebook-f"></i>
          </a>
          
          <a href="https://twitter.com/intent/tweet?url=<?php echo $current_url; ?>&text=<?php echo $title; ?>" target="_blank" class="social-btn twitter">
            <i class="fab fa-twitter"></i>
          </a>
          
          <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $current_url; ?>&title=<?php echo $title; ?>&summary=<?php echo $description; ?>" target="_blank" class="social-btn linkedin">
            <i class="fab fa-linkedin-in"></i>
          </a>
          
          <a href="https://pinterest.com/pin/create/button/?url=<?php echo $current_url; ?>&media=<?php echo urlencode($blog['banner_image']); ?>&description=<?php echo $title; ?>" target="_blank" class="social-btn pinterest">
            <i class="fab fa-pinterest-p"></i>
          </a>
          
          <a href="https://www.instagram.com/" target="_blank" class="social-btn instagram">
            <i class="fab fa-instagram"></i>
          </a>
          
          <a href="https://wa.me/?text=<?php echo $title . ' ' . $current_url; ?>" target="_blank" class="social-btn whatsapp">
            <i class="fab fa-whatsapp"></i>
          </a>
          
          <a href="#" class="social-btn copy-link" onclick="copyBlogLink(event)">
            <i class="fas fa-link"></i>
            <span class="copy-message">Link Copied!</span>
          </a>
        </div>
        <div class="share-text">
          Click any icon to share this post
        </div>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <h3>Recent Posts</h3>
      <?php
      // Get recent posts from the same category only
      $category_id = $blog['category_id'];
      $recent = $conn->query("SELECT b.custom_slug, b.banner_image, b.banner_image_alt, b.posted_on, c.slug AS cat_slug, c.name AS category 
                              FROM blogs b 
                              JOIN categories c ON b.category_id = c.id 
                              WHERE b.category_id = $category_id AND b.id != {$blog['id']}
                              ORDER BY b.posted_on DESC LIMIT 5");
      while($r = $recent->fetch_assoc()):
      ?>
        <div class="recent-post">
          <?php if ($r['banner_image']): ?>
            <img src="<?php echo htmlspecialchars($r['banner_image']); ?>" alt="<?php echo htmlspecialchars($r['banner_image_alt']); ?>">
          <?php endif; ?>
          <div>
            <a href="/blog-website/<?php echo $r['cat_slug'].'/'.$r['custom_slug']; ?>">
              <?php echo htmlspecialchars($r['custom_slug']); ?>
            </a>
            <small><?php echo htmlspecialchars($r['category']); ?> | <?php echo date('d M Y', strtotime($r['posted_on'])); ?></small>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <script>
    // Function to copy blog link
    function copyBlogLink(event) {
      event.preventDefault();
      const url = window.location.href;
      
      // Modern approach with Clipboard API
      if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(url).then(function() {
          showCopyMessage(event.currentTarget);
        }).catch(function(err) {
          // If Clipboard API fails, use fallback method
          fallbackCopyTextToClipboard(url, event.currentTarget);
        });
      } else {
        // Use fallback method for older browsers or HTTP
        fallbackCopyTextToClipboard(url, event.currentTarget);
      }
    }
    
    // Fallback method for copying text
    function fallbackCopyTextToClipboard(text, targetElement) {
      const textArea = document.createElement("textarea");
      textArea.value = text;
      textArea.style.position = "fixed";
      textArea.style.left = "-999999px";
      textArea.style.top = "-999999px";
      document.body.appendChild(textArea);
      textArea.focus();
      textArea.select();
      
      try {
        const successful = document.execCommand('copy');
        if (successful) {
          showCopyMessage(targetElement);
        } else {
          alert('Failed to copy link. Please copy manually: ' + text);
        }
      } catch (err) {
        console.error('Fallback: Oops, unable to copy', err);
        alert('Failed to copy link. Please copy manually: ' + text);
      }
      
      document.body.removeChild(textArea);
    }
    
    // Show copy confirmation message
    function showCopyMessage(targetElement) {
      const copyMessage = targetElement.querySelector('.copy-message');
      copyMessage.classList.add('show');
      
      // Hide message after 2 seconds
      setTimeout(function() {
        copyMessage.classList.remove('show');
      }, 2000);
    }
    
    // Function to share blog using Web Share API
    function shareBlog() {
      if (navigator.share) {
        navigator.share({
          title: '<?php echo addslashes($blog['page_title']); ?>',
          text: '<?php echo addslashes(strip_tags($blog['content'])); ?>',
          url: window.location.href
        })
        .then(() => console.log('Successful share'))
        .catch((error) => console.log('Error sharing:', error));
      } else {
        // Fallback: copy to clipboard
        copyBlogLink(event);
      }
    }
  </script>

  <!-- JSON-LD structured data placed just above body close -->
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

<?php
include('common/footer.php');
?>