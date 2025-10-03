<?php
$quickLinks = [
  ["label" => "Home", "url" => "index.php"],
  ["label" => "About", "url" => "about.php"],
  ["label" => "Contact Us", "url" => "contact.php"],
];
?>
<footer class="unique-footer">
  <div class="unique-footer-container">
    <div class="unique-footer-row">

      <!-- About -->
      <div class="unique-footer-col">
        <h3 class="unique-footer-heading">About Us</h3>
        <p class="unique-footer-text">
          At <b>Blogs</b>, we bring you inspiring articles, fresh ideas,  
          and authentic stories that connect knowledge with creativity.  
          Explore topics that inform, inspire, and keep you updated.
        </p>
      </div>

      <!-- Quick Links -->
      <div class="unique-footer-col">
        <h3 class="unique-footer-heading">Quick Links</h3>
        <ul class="unique-footer-links">
          <?php foreach ($quickLinks as $link): ?>
            <li>
              <a href="<?= $link['url'] ?>" class="unique-footer-link">
                <?= $link['label'] ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Contact -->
      <div class="unique-footer-col">
        <h3 class="unique-footer-heading">Contact Us</h3>
        <p class="unique-footer-text">Patna, Bihar</p>
        <p class="unique-footer-text">+91 9135XXXXXX</p>
        <p class="unique-footer-text">support@blogs.com</p>
      </div>

      <!-- Social -->
      <div class="unique-footer-col">
        <h3 class="unique-footer-heading">Follow Us</h3>
        <div class="unique-footer-social">
          <a href="#" class="unique-footer-icon"><i class="bi bi-facebook"></i></a>
          <a href="#" class="unique-footer-icon"><i class="bi bi-instagram"></i></a>
          <a href="#" class="unique-footer-icon"><i class="bi bi-twitter"></i></a>
        </div>
      </div>

    </div>

    <!-- Bottom -->
    <div class="unique-footer-bottom">
      © 2025 Design with <span class="unique-footer-heart">❤️</span> 
      <span class="unique-footer-brand">Irteza Saquib</span> | Blogs | 
      All Rights Reserved.
    </div>
  </div>
</footer>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
  /* ===== Unique Footer ===== */
  .unique-footer {
    background-color: #000;
    color: #F37600;
    padding: 50px 20px 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .unique-footer-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  .unique-footer-row {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: space-between;
  }

  .unique-footer-col {
    flex: 1 1 220px;
    min-width: 200px;
  }

  .unique-footer-heading {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 15px;
    border-left: 4px solid #F37600;
    padding-left: 10px;
  }

  .unique-footer-text {
    font-size: 14px;
    margin-bottom: 8px;
    line-height: 1.6;
  }

  .unique-footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .unique-footer-link {
    color: #F37600;
    text-decoration: none;
    font-size: 14px;
    transition: 0.3s;
  }
  .unique-footer-link:hover {
    color: #fff;
    padding-left: 5px;
  }

  .unique-footer-social {
    display: flex;
    gap: 15px;
    font-size: 20px;
  }

  .unique-footer-icon {
    color: #F37600;
    transition: 0.3s;
  }
  .unique-footer-icon:hover {
    color: #fff;
    transform: scale(1.1);
  }

  .unique-footer-bottom {
    margin-top: 30px;
    padding-top: 20px;
    font-size: 13px;
    text-align: center;
    border-top: 1px solid rgba(243, 118, 0, 0.3);
    color: #F37600;
  }

  .unique-footer-heart {
    color: red;
  }

  .unique-footer-brand {
    font-weight: bold;
    color: #F37600;
  }

  @media(max-width: 768px) {
  .unique-footer {
    padding: 15px 10px; 
  }

  .unique-footer-row {
    flex-direction: column;
    gap: 25px; 
  }

  .unique-footer-col {
    flex: unset;  
    min-width: unset;
    margin-bottom: 5px;
  }

  .unique-footer-heading {
    font-size: 15px;
    margin-bottom: 4px;
  }

  .unique-footer-text, 
  .unique-footer-link {
    font-size: 12px;
    line-height: 1.4; 
    margin-bottom: 4px;
  }

  .unique-footer-social {
    gap: 8px;
    font-size: 18px;
  }

  .unique-footer-bottom {
    margin-top: 10px;
    padding-top: 8px;
    font-size: 11px;
  }
}

</style>
