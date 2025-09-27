<?php
// Base URL for the project
include('base.php');

// Current page
$current_page = basename($_SERVER['PHP_SELF']);

// Navigation items
$navItems = [
  ["label" => "Home", "icon" => '<i class="bi bi-house"></i>', "link" => "index.php"],
  ["label" => "About", "icon" => '<i class="bi bi-info-circle"></i>', "link" => "about.php"],
  ["label" => "Blog", "icon" => '<i class="bi bi-pencil-square"></i>', "link" => "blog-list.php"],
  ["label" => "Contact", "icon" => '<i class="bi bi-envelope"></i>', "link" => "contact.php"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <title>Blogs</title> -->
  <link rel="icon" type="image/jpg" href="<?= $base_url ?>/images/blog-logos.jpg" />
  
  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    /* Navbar styling */
    .navbar-custom {
      background: #fff;
      box-shadow: 0px 2px 6px rgba(0,0,0,0.15);
    }
    .navbar-brand span {
      color: #F37600;
      font-weight: bold;
      font-size: 1.5rem;
    }
    .nav-link {
      font-weight: 600;
      transition: all 0.3s ease;
      color: #F37600 !important;
      border-bottom: 2px solid transparent;
    }
    .nav-link.active,
    .nav-link:hover {
      color: #16a34a !important;
      border-bottom: 2px solid #16a34a;
      padding-bottom: 2px;
    }
    .social-icons a {
      font-size: 1.2rem;
      color: #F37600;
      transition: 0.3s;
    }
    .social-icons a:hover {
      color: #16a34a;
    }
    .navbar-toggler {
      color: #F37600 !important;
      border: none;
      font-size: 1.5rem;
    }
    .navbar-toggler:focus {
      box-shadow: none;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-custom fixed-top px-3">
  <div class="container-fluid">

    <a class="navbar-brand d-flex align-items-center" href="<?= $base_url ?>/index.php">
      <div class="me-2">
        <span>Blogs</span>
      </div>
    </a>

    <!-- Toggle Button -->
    <button class="navbar-toggler" type="button">
      <i class="fas fa-bars" id="toggleIcon"></i>
    </button>

    <!-- Collapse Menu -->
    <div class="collapse navbar-collapse justify-content-center" id="mainNav">
      <ul class="navbar-nav mb-2 mb-md-0">
        <?php foreach($navItems as $item):
          $isActive = ($current_page === $item['link']) ? 'active' : '';
        ?>
          <li class="nav-item mx-2">
            <a href="<?= $base_url ?>/<?= $item['link'] ?>" class="nav-link <?= $isActive ?>">
              <?= $item['icon'] ?> <?= $item['label'] ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- Social Icons -->
    <div class="social-icons d-none d-md-flex gap-3">
      <a href="#"><i class="bi bi-facebook"></i></a>
      <a href="#"><i class="bi bi-instagram"></i></a>
      <a href="#"><i class="bi bi-twitter"></i></a>
      <a href="#"><i class="bi bi-youtube"></i></a>
      <a href="#"><i class="bi bi-linkedin"></i></a>
    </div>

  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const toggler = document.querySelector('.navbar-toggler');
  const navCollapse = document.getElementById('mainNav');
  const toggleIcon = document.getElementById('toggleIcon');

  toggler.addEventListener('click', () => {
    navCollapse.classList.toggle('show');
    toggleIcon.classList.toggle('fa-times');
    toggleIcon.classList.toggle('fa-bars');
  });

  // Close menu on click outside
  document.addEventListener('click', function(event) {
    if (!toggler.contains(event.target) && !navCollapse.contains(event.target)) {
      if (navCollapse.classList.contains('show')) {
        navCollapse.classList.remove('show');
        toggleIcon.classList.remove('fa-times');
        toggleIcon.classList.add('fa-bars');
      }
    }
  });
</script>

</body>
</html>
