<?php
// Footer links (agar aap future me dynamic banana chahte ho)
$quickLinks = [
  ["label" => "Home", "url" => "index.php"],
  ["label" => "About", "url" => "menu.php"],
  ["label" => "Services", "url" => "top-dishes.php"],
  ["label" => "Contact Us", "url" => "contact.php"],
];
?>
<footer class="custom-footer text-[#F37600] py-5">
  <div class="container">
    <div class="row gy-4">
      
      <!-- About Us -->
      <div class="col-12 col-md-3">
        <h3 class="h6 fw-bold mb-3">About Us</h3>
       <p class="small mb-0">
  At <b>Blogs</b>, we bring you inspiring articles, fresh ideas,  
  and authentic stories that connect knowledge with creativity.  
  Explore topics that inform, inspire, and keep you updated.
</p>

      </div>

      <!-- Quick Links -->
      <div class="col-12 col-md-3">
        <h3 class="h6 fw-bold mb-3">Quick Links</h3>
        <ul class="list-unstyled">
          <?php foreach ($quickLinks as $link): ?>
            <li class="mb-2">
              <a href="<?= $link['url'] ?>" class="footer-link small">
                <?= $link['label'] ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Contact -->
      <div class="col-12 col-md-3">
        <h3 class="h6 fw-bold mb-3">Contact Us</h3>
        <p class="small mb-1">Patna, Bihar</p>
        <p class="small mb-1">+91 9135XXXXXX</p>
        <p class="small mb-0">support@blogs.com</p>
      </div>

      <!-- Social Media -->
      <div class="col-12 col-md-3">
        <h3 class="h6 fw-bold mb-3">Follow Us</h3>
        <div class="d-flex gap-3 fs-4">
          <a href="#" class="footer-icon"><i class="bi bi-facebook"></i></a>
          <a href="#" class="footer-icon"><i class="bi bi-instagram"></i></a>
          <a href="#" class="footer-icon"><i class="bi bi-twitter"></i></a>
        </div>
      </div>

    </div>

    <!-- Bottom Bar -->
    <div class="text-center small mt-4 pt-3 border-top border-light text-orange">
      © 2025 Design with <span class="text-orange">❤️</span> by 😎 
      <span class="fw-bold text-orange">Irteza Saquib</span> | Blogs | [Fully Dynamic Blogs]. 
      All Rights Reserved.
    </div>
  </div>
</footer>


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


<style>
  .custom-footer {
    background-color: black; 
    color: #F37600;
  }
  .footer-link {
    color: #F37600;
    text-decoration: none;
    transition: 0.3s;
  }
  .footer-link:hover {
    text-decoration: underline;
    color: #F37600;
  }
  .footer-icon {
    color: #F37600;
    transition: 0.3s;
  }
  .footer-icon:hover {
    color: #F37600;
  }
  .text-orange {
    color: #F37600 !important;
  }
</style>
