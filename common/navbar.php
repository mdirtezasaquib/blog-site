<?php
$active = "Home"; 

$navItems = [
  ["label" => "Home", "icon" => '<i class="bi bi-house"></i>'],
  ["label" => "About", "icon" => '<i class="bi bi-info-circle"></i>'],
  ["label" => "Services", "icon" => '<i class="bi bi-gear"></i>'],
  ["label" => "Contact", "icon" => '<i class="bi bi-envelope"></i>']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blogs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    .navbar-custom {
      background: black;
      box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
    }
    .navbar-brand span {
      color: #F37600;
      font-weight: bold;
      line-height: 1;
    }
    /* .brand-icon {
      background: #16a34a;
      padding: 8px;
      border-radius: 50%;
      color: #facc15;
      font-size: 1.2rem;
    } */
    .nav-link {
      font-weight: 600;
      transition: 0.3s;
     color: #F37600 !important;
      border-bottom: 2px solid transparent;
    }
    .nav-link.active,
    .nav-link:hover {
      color: #F37600 !important;
      border-bottom: 2px solid #F37600;
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

    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <div class="me-2">
        <span>Blogs</span><br>
      </div>
      <!-- <div class="brand-icon">
        <i class="bi bi-egg-fried"></i>
      </div> -->
    </a>

    <!-- Toggle Button -->
    <button class="navbar-toggler border-0" type="button">
      <i class="fas fa-bars custom-toggler-icon" id="toggleIcon"></i>
    </button>

    <!-- Collapse Menu -->
    <div class="collapse navbar-collapse justify-content-center" id="mainNav">
      <ul class="navbar-nav mb-2 mb-md-0">
        <?php foreach($navItems as $item): 
          $label = $item['label'];
          $icon = $item['icon'];
          $link = ($label === "Home") ? "index.php" : strtolower(str_replace(" ", "-", $label)) . ".php";
        ?>
          <li class="nav-item mx-2">
            <a href="<?= $link ?>" 
               class="nav-link <?= ($active === $label) ? 'active' : '' ?>">
              <?= $icon ?> <?= $label ?>
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
  const navCollapse = document.getElementById('mainNav'); // ✅ Fixed ID
  const toggleIcon = document.getElementById('toggleIcon');

  toggler.addEventListener('click', () => {
    navCollapse.classList.toggle('show');

    if (navCollapse.classList.contains('show')) {
      toggleIcon.classList.remove('fa-bars');
      toggleIcon.classList.add('fa-times');
    } else {
      toggleIcon.classList.remove('fa-times');
      toggleIcon.classList.add('fa-bars');
    }
  });

  // Click outside to close
  document.addEventListener('click', function (event) {
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
