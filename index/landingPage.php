<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blogging Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
  body {
    overflow-x: hidden;
  }
  .hero-section {
    background: white;
    min-height: 100vh;
    margin-top: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
  }
  .hero-box {
    backdrop-filter: blur(12px);
    background: white;
    border: 1px dashed #F37600;
    border-radius: 1.5rem;
    padding: 1.5rem;
    box-shadow: 0px 8px 30px rgba(0,0,0,0.2);
    max-width: 100%;
      margin-top: 2vh;
  }
  .hero-title {
    font-weight: 800;
    text-shadow: 1px 2px 4px rgba(0,0,0,0.1);
  }
  .highlight {
    color: #F37600;
  }
  .hero-btn {
    background: #F37600;
    color: #fff;
    font-weight: 600;
    transition: 0.3s;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
  }
  .hero-btn:hover {
    background: #F37600;
    transform: scale(1.05);
  }
  .hero-img {
    max-width: 100%;
    height: auto;
  }
  @media (min-width: 768px) {
    .hero-box {
    
      padding: 3rem;
    }
    .hero-img {
      max-width: 480px;
    }
  }
</style>

</head>
<body>

<div class="hero-section">
  <div class="container hero-box d-flex flex-column flex-md-row align-items-center justify-content-between gap-5">

    <!-- Left Content -->
    <div class="text-center text-md-start">
      <h1 class="hero-title display-5 mb-3 text-dark">
        Discover the World of  
        <span class="highlight"> Blogging</span>
      </h1>
      <p class="text-secondary fw-semibold fs-5 mb-4">
        Inspiring stories, expert insights, and the latest trends—crafted for curious readers and passionate writers.
      </p>
      <a href="blogs.php" class="btn hero-btn btn-lg px-4 py-3 d-flex align-items-center justify-content-center gap-2 mx-auto mx-md-0">
        <i class="bi bi-journal-text"></i> Explore Blogs
      </a>
      <p class="mt-4 text-muted fst-italic small d-flex align-items-center justify-content-center justify-content-md-start gap-2">
        <!-- <i class="bi bi-star-fill text-warning"></i> -->
        Trusted by 5,000+ writers & readers worldwide
      </p>
    </div>

    <!-- Right Image -->
    <div class="text-center">
      <img src="images/blogs.png" 
           alt="Blogging Illustration" 
           class="img-fluid hero-img">
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
