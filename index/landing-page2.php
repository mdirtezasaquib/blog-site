<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Blog</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <!-- AOS Animation -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

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
      /* background: linear-gradient(135deg, rgba(0, 51, 153, 0.85), rgba(0, 204, 255, 0.75)); */
      animation: gradientMove 10s infinite alternate ease-in-out;
    
    }

    /* @keyframes gradientMove {
      0% { background: linear-gradient(135deg, rgba(0, 51, 153, 0.85), rgba(0, 204, 255, 0.75)); }
      100% { background: linear-gradient(135deg, rgba(255, 0, 128, 0.85), rgba(0, 153, 255, 0.75)); }
    } */

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
  </style>
</head>
<body>

<!-- Hero Section -->
<section class="hero">
  <div class="hero-content" data-aos="fade-up">
    <h1>Your <span>AI Powered</span><br> Digital Growth Partner</h1>
    <p>We are an Artificial Intelligence enabled growth agency that helps you accelerate your business to achieve maximum ROI.</p>

    <!-- Email Form -->
    <form class="email-form" action="#" method="post" data-aos="zoom-in">
      <input type="email" placeholder="Enter your work email" required>
      <button type="submit" class="btn btn-primary-custom">Get Free Proposal</button>
    </form>

    <!-- CTA Buttons -->
    <div>
      <!-- <a href="#services" class="btn btn-custom btn-primary-custom">Our Services</a>
      <a href="#contact" class="btn btn-custom btn-outline-custom">Contact Us</a> -->
    </div>
  </div>
</section>

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
