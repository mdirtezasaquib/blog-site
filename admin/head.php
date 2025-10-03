<?php
session_start();
if (!isset($_SESSION['userlogin'])) {
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <link rel="icon" type="../images/architect-logo.webp" href="../images/architect-logo.webp" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    :root {
     --primary-gradient: linear-gradient(135deg, #ffeb3b 0%, #ffc107 100%);
  --secondary-gradient: linear-gradient(135deg, #fff176 0%, #ffd54f 100%);
  --success-gradient: linear-gradient(135deg, #ffee58 0%, #ffca28 100%);
  --warning-gradient: linear-gradient(135deg, #fff59d 0%, #ffb300 100%);
      --dark-color: #1a1a2e;
      --light-color: black;
      --sidebar-width: 250px;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f7fa;
      padding-top: 70px;
    }
    
    /* Navbar Styling */
    .navbar {
      background: var(--primary-gradient);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
      z-index: 1050;
      padding: 0.5rem 1rem;
      transition: all 0.3s ease;
    }
    
    .navbar-brand {
      font-weight: 700;
      color: var(--light-color) !important;
      display: flex;
      align-items: center;
      font-size: 1.5rem;
    }
    
    .navbar-brand i {
      margin-right: 10px;
      font-size: 1.8rem;
    }
    
    .nav-link {
      color: var(--light-color) !important;
      font-weight: 500;
      margin: 0 8px;
      padding: 0.5rem 1rem !important;
      border-radius: 8px;
      transition: all 0.3s ease;
      position: relative;
      display: flex;
      align-items: center;
    }
    
    .nav-link i {
      margin-right: 8px;
      font-size: 1.1rem;
    }
    
    .nav-link:hover, .nav-link.active {
      background: rgba(255, 255, 255, 0.15);
      color: var(--light-color) !important;
      transform: translateY(-2px);
    }
    
    /* Profile Section */
    .profile-circle {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: var(--warning-gradient);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: var(--light-color);
      margin-right: 15px;
      font-size: 1.2rem;
    
      transition: all 0.3s ease;
    }
    
    .profile-circle:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
    }
    
    .logout-btn {
      background: var(--secondary-gradient);
      border: none;
      color: var(--light-color);
      font-weight: 500;
      padding: 8px 20px;
      border-radius: 30px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
    
    .logout-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }
    
    .navbar-toggler {
      border: none;
      padding: 0.25rem 0.5rem;
      transition: all 0.3s ease;
    }
    
    .navbar-toggler:focus {
      box-shadow: none;
    }
    
    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      transition: all 0.3s ease;
    }
    
    .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 4L26 26M4 26L26 4'/%3e%3c/svg%3e");
    }
    
  
    @media (max-width: 991.98px) {
      .navbar-collapse {
        position: fixed;
        top: 55px;
        left: 0;
        padding: 1rem;
        width: 100%;
        height: calc(100vh - 55px);
        background: var(--warning-gradient);
        z-index: 1000;
        overflow-y: auto;
        transition: all 0.3s ease;
        transform: translateX(-100%);
      }
      
      .navbar-collapse.show {
        transform: translateX(0);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      }
      
      .nav-item {
        margin: 10px 0;
      }
      
      .nav-link {
        padding: 0.75rem 1rem !important;
        margin: 5px 0;
        border-radius: 6px;
        justify-content: flex-start;
        
      }
      
      .d-flex.align-items-center {
        flex-direction: column;
        margin-top: 20px;
      }
      
      .profile-circle {
        margin-right: 0;
        margin-bottom: 15px;
      }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <i class="fas fa-crown"></i>Admin Panel
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarAdmin">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

       <li class="nav-item">
          <a class="nav-link active" href="index.php">
           <i class="fas fa-home"></i>
Home
           
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create-category.php">
            <i class="fas fa-project-diagram"></i>Category
           
          </a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="blog-list.php">
            <i class="fas fa-blog"></i>Blogs
           
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="email-list.php">
            <i class="fas fa-users"></i>Emails
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="contact-list.php">
            <i class="fas fa-users"></i>Contacts
          </a>
        </li>
      
      </ul>

      <div class="d-flex align-items-center">
        <div class="profile-circle">
          <i class="fas fa-user"></i>
        </div>
        <form method="post" action="logout.php">
          <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt me-2"></i>Logout
          </button>
        </form>
      </div>
    </div>
  </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  
  document.addEventListener('click', function(event) {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    const isClickInsideNavbar = event.target.closest('.navbar');
    
    if (navbarCollapse.classList.contains('show') && !isClickInsideNavbar) {
      navbarToggler.click();
    }
  });
  
  
  document.querySelector('.navbar-toggler').addEventListener('click', function() {
    this.classList.toggle('active');
  });
  
  
  document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function() {
      document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
      this.classList.add('active');
      
      
      if (window.innerWidth < 992) {
        document.querySelector('.navbar-toggler').click();
      }
    });
  });
</script>
</body>
</html>