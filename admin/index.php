<?php include('head.php'); ?>
<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../images/icons/logo.png" rel="icon">
  <title>Admin Dashboard - Blogs Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                  url('') center/cover no-repeat;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      color: #fff;
    }

    .hero {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 20px;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: 800;
      color: #ffcc00;
      margin-bottom: 15px;
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    .hero p {
      font-size: 1.2rem;
      max-width: 700px;
      margin-bottom: 30px;
      line-height: 1.8;
      color: #f0f0f0;
    }

    .hero-icon {
      font-size: 4.5rem;
      color: #ffcc00;
      margin-bottom: 20px;
      animation: pulse 2s infinite;
    }

    .btn-dashboard {
      background: #ffcc00;
      color: #003d32;
      font-weight: 700;
      padding: 12px 30px;
      border-radius: 30px;
      text-transform: uppercase;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .btn-dashboard:hover {
      background: #ffaa00;
      color: #000;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(255, 204, 0, 0.4);
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }

    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.2rem;
      }
      .hero p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

  <section class="hero">
    <i class="fa-solid fa-blog hero-icon"></i>
    <h1>Blogs Admin Dashboard</h1>
    <p>
      Welcome to <strong>Blogs Admin Panel</strong>.<br>
      From here, you can manage all your blog posts, categories, authors, and user comments.<br>
      Keep your content engaging, organized, and ready for your readers.
    </p>
    <a href="blog_list.php" class="btn btn-dashboard">
      <i class="fa-solid fa-list me-2"></i>Manage Blogs
    </a>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
