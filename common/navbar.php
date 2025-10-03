<?php
include('base.php');
include('admin/config.php');


$current_page = basename($_SERVER['PHP_SELF']);


$categories = [];
$catQuery = $conn->query("SELECT name, slug FROM categories ORDER BY name ASC");
while($row = $catQuery->fetch_assoc()) {
    $categories[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
/* Navbar Styling */
.navbar-custom {
  background: #fff;
  box-shadow: 0px 2px 6px rgba(0,0,0,0.15);
  padding: 0.6rem 1rem;
}
.navbar-brand {
  font-weight: bold;
  font-size: 1.4rem;
  color: #F37600 !important;
}
.nav-link {
  color: #F37600 !important;
  font-weight: 600;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 6px;
}
.nav-link.active,
.nav-link:hover {
  color: #16a34a !important;
  border-bottom: 2px solid #16a34a;
  padding-bottom: 2px;
}
.dropdown-menu a {
  color: #F37600 !important;
  font-weight: 500;
}
.dropdown-menu a:hover {
  background: #16a34a;
  color: #fff !important;
}
.navbar-toggler {
  border: none;
  font-size: 1.5rem;
  color: #F37600;
}
.navbar-toggler:focus {
  outline: none;
  box-shadow: none;
}

/* Social Icons */
.social-icons a {
  font-size: 1.2rem;
  margin-left: 12px;
  color: #F37600;
  transition: 0.3s;
}
.social-icons a:hover {
  color: #16a34a;
}

/* Only desktop me center kare */
@media (min-width: 768px) {
  #mainNav {
    position: absolute !important;
    left: 50%;
    transform: translateX(-50%);
    flex-grow: 0 !important;
  }
}

@media (max-width: 767px) {
  #mainNav {
    position: static !important;
    transform: none !important;
    width: 100% !important;
    background: #fff;
    padding: 10px;
  }
}


</style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-custom fixed-top">
  <div class="container-fluid d-flex align-items-center justify-content-between">

    <!-- Brand -->
    <a class="navbar-brand" href="<?= $base_url ?>/index.php">
      <i class="bi bi-journal-text"></i> Blogs
    </a>

    <!-- Navbar Links -->
    <div class="collapse navbar-collapse position-absolute start-50 translate-middle-x" id="mainNav">
      <ul class="navbar-nav mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link <?= $current_page=='index.php'?'active':'' ?>" href="<?= $base_url ?>/index.php">
            <i class="bi bi-house-door"></i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current_page=='about.php'?'active':'' ?>" href="<?= $base_url ?>/about.php">
            <i class="bi bi-info-circle"></i> About
          </a>
        </li>

        <!-- Blog with Split Dropdown -->
       <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-pencil-square"></i> Blog
  </a>
  <ul class="dropdown-menu">
    <?php foreach($categories as $cat): ?>
      <li>
        <a class="dropdown-item" href="<?= $base_url ?>/<?= $cat['slug'] ?>">
          <?= htmlspecialchars($cat['name']) ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</li>


        <li class="nav-item">
          <a class="nav-link <?= $current_page=='contact.php'?'active':'' ?>" href="<?= $base_url ?>/contact.php">
            <i class="bi bi-envelope"></i> Contact
          </a>
        </li>
      </ul>
    </div>

    <!-- Social Icons (Right Side) -->
    <div class="social-icons d-none d-md-flex">
      <a href="#"><i class="bi bi-facebook"></i></a>
      <a href="#"><i class="bi bi-instagram"></i></a>
      <a href="#"><i class="bi bi-twitter-x"></i></a>
      <a href="#"><i class="bi bi-linkedin"></i></a>
      <a href="#"><i class="bi bi-youtube"></i></a>
    </div>

    <!-- Toggler -->
    <button class="navbar-toggler ms-2" type="button">
      <i class="fas fa-bars" id="toggleIcon"></i>
    </button>
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
