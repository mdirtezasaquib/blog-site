<?php include('common/navbar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .contact-section {
      padding: 60px 18px;
     
    }
    .contact-container {
      overflow: hidden;
      max-width: 1100px;
      width: 100%;
      margin: auto;
    }
    .contact-left {
      background: url('') no-repeat center center/cover;
      padding: 60px 40px;
      color: #F37600;
      display: flex;
      flex-direction: column;
      /* justify-content: center; */
    }
    .contact-left h2 {
      font-size: 40px;
      font-weight: 800;
      line-height: 1.2;
    }
    .contact-left p {
      margin-top: 15px;
      font-size: 16px;
    }
    .contact-form {
      padding: 40px;
    }
    .form-control {
      border-radius: 10px;
      padding: 12px 15px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
    }
    .btn-custom {
      background: white;
      color: #F37600;
      font-size: 18px;
      padding: 12px 30px;
      border-radius: 30px;
      font-weight: 600;
      transition: 0.3s ease-in-out;
      border: none;
      width: 100%;
      border : 1px solid #F37600;
    }

    .btn-custom:hover{
      background-color: #F37600;
      color: white;
    }
   
    .map-container {
      border : 1px solid #F37600;
      margin-top: 20px;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    /* Responsive */
    @media (max-width: 992px) {
      .contact-left {
        padding: 40px 20px;
        text-align: center;
      }
      .contact-left h2 {
        font-size: 32px;
      }
    }
    @media (max-width: 576px) {
      .contact-form {
        padding: 25px;
      }
      .btn-custom {
        font-size: 16px;
        padding: 10px 20px;
      }
    }
  </style>
</head>
<body>

<!-- Contact Section -->
<section class="contact-section">
  <div class="contact-container row g-0">
    
   <!-- Left Side -->
<div class="contact-left col-lg-5">
  <h2>Let’s,<br> Talk About You</h2>
  <p>We’d love to hear from you! Fill out the form and let’s connect.  
  You can also find our location below.</p>

  <!-- Contact Info Column Wise -->
  <div class="mt-4">
    <!-- Phone -->
    <div class="d-flex align-items-center mb-3 p-3  rounded shadow-sm" style="border: 1px solid #F37600;">
      <i class="bi bi-person-fill fs-4 me-3" style="color:#F37600;"></i>
      <span class="fw-semibold">+211234565523</span>
    </div>

    <!-- Email -->
    <div class="d-flex align-items-center mb-3 p-3 rounded shadow-sm" style="border: 1px solid #F37600;">
      <i class="bi bi-envelope-fill fs-4 me-3" style="color:#F37600;"></i>
      <span class="fw-semibold">info@email.com</span>
    </div>

    <!-- Address -->
    <div class="d-flex align-items-center mb-3 p-3 rounded shadow-sm" style="border: 1px solid #F37600;">
      <i class="bi bi-geo-alt-fill fs-4 me-3" style="color:#F37600;"></i>
      <span class="fw-semibold">9567 Turner Trace Apt. BC C3G8A4</span>
    </div>
  </div>
</div>


    <!-- Right Side -->
    <div class="col-lg-7 contact-form">
     <h3 class="fw-semi-bold" style="color:#F37600;">Send Us A Message &rarr;</h3>

      
      <form>
        <input type="text" class="form-control" placeholder="Full Name *" required>
        <input type="email" class="form-control" placeholder="Email Address *" required>
        <input type="text" class="form-control" placeholder="Subject *" required>
        <textarea class="form-control" rows="5" placeholder="Your Message Here *" required></textarea>
        <button type="submit" class="btn-custom">Send Now</button>
      </form>

      <!-- Google Map -->
      <!-- <div class="map-container mt-4">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241317.1160990325!2d72.74109949999999!3d19.0821978!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b63c83e1d1b5%3A0xdea35bb1e3d0c!2sMumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1693319639627!5m2!1sen!2sin" 
          width="100%" 
          height="250" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy"></iframe>
      </div> -->
    </div>
  </div>
</section>






<!-- Footer -->
<?php include('common/footer.php'); ?>

</body>
</html>
