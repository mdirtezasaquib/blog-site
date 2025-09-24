<?php
include 'admin/config.php';
include('common/navbar.php');

// Category filter
$filter_category = isset($_GET['category']) ? $_GET['category'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>All Blogs</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --orange: #F37600;
      --orange-light: #FF9A40;
      --orange-dark: #D45A00;
      --black: #222222;
      --white: #FFFFFF;
      --gray-light: #F5F5F5;
      --gray: #777777;
      --transition: all 0.3s ease;
    }
    
   
    .page-header {
      text-align: center; 
      margin: 80px 0 50px; 
      position: relative;
      padding: 0 20px;
    }
    
    .page-title {
      font-family: "Playfair Display", serif;
      font-size: 2.5rem; 
      font-weight: 600;
      color: var(--orange);
      margin-bottom: 20px;
      position: relative;
      display: inline-block;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .page-subtitle {
      color: var(--black);
      font-size: 1.2rem;
      max-width: 700px;
      margin: 30px auto 0;
      font-weight: 400;
      background: rgba(243, 118, 0, 0.1);
      padding: 15px 25px;
      border-radius: 12px;
    
    }

    /* Main Container */
    .container { 
      display: flex; 
      flex-direction: row-reverse;
      gap: 40px; 
      padding: 20px; 
      max-width: 1400px; 
      margin: 0 auto 60px; 
    }

    /* Category Filter - Right Side */
    .filter-container {
      width: 300px;
      position: sticky;
      top: 120px;
      align-self: flex-start;
      z-index: 10;
    }
    
    .filter-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: var(--white);
      padding: 20px;
      border-radius: 16px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      cursor: pointer;
      transition: var(--transition);
      border: 2px solid var(--orange-light);
    }
    
    .filter-header:hover {
      box-shadow: 0 8px 25px rgba(243, 118, 0, 0.2);
      transform: translateY(-3px);
    }
    
    .filter-header h3 {
      margin: 0;
      font-size: 1.2rem;
      font-weight: 600;
      color: var(--orange);
      display: flex;
      align-items: center;
      gap: 12px;
    }
    
    .filter-header i {
      transition: var(--transition);
      color: var(--orange);
      font-size: 1.1rem;
    }
    
    .filter-content {
      background: var(--white);
      margin-top: 15px;
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      display: none;
      border: 2px solid var(--orange-light);
    }
    
    .filter-content.active {
      display: block;
      animation: fadeIn 0.4s ease;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-15px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .filter-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .filter-list li { 
      margin-bottom: 12px; 
    }
    
    .filter-list li a { 
      text-decoration: none; 
      color: var(--black);
      display: flex;
      align-items: center;
      padding: 14px 18px;
      border-radius: 12px; 
      transition: var(--transition);
      font-weight: 500;
      position: relative;
      overflow: hidden;
      border: 1px solid transparent;
    }
    
    .filter-list li a:before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 5px;
      background: var(--orange);
      opacity: 0;
      transition: var(--transition);
    }
    
    .filter-list li a:hover,
    .filter-list li a.active { 
      background: rgba(243, 118, 0, 0.1);
      color: var(--orange);
      padding-left: 25px;
      border-color: var(--orange-light);
    }
    
    .filter-list li a:hover:before,
    .filter-list li a.active:before {
      opacity: 1;
    }
    
    .filter-list li a i { 
      margin-right: 15px;
      font-size: 1.1rem;
      width: 24px;
      text-align: center;
      color: var(--orange);
    }

    /* Blogs Grid - 3 cards per row */
    .blogs { 
      flex: 1; 
      display: grid; 
      grid-template-columns: repeat(3, 1fr); 
      gap: 35px; 
    }

    /* Blog Card - Enhanced Design */
    .card { 
      background: var(--white); 
     
      overflow: hidden; 
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      transition: var(--transition); 
      text-decoration: none; 
      color: inherit; 
      display: flex; 
      flex-direction: column;
      height: 100%;
      position: relative;
    }
    
    .card:hover { 
      transform: translateY(-10px); 
      box-shadow: 0 15px 35px rgba(243, 118, 0, 0.25);
    }
    
    .card-img-container {
      position: relative;
      overflow: hidden;
      height: 200px;
    }
    
    .card img { 
      width: 100%; 
      height: 100%; 
      object-fit: cover;
      transition: transform 0.7s ease;
    }
    
    .card:hover img {
      transform: scale(1.1);
    }
    
    .card-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);
      height: 50%;
      pointer-events: none;
    }
    
    .card-content { 
      padding: 10px; 
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    
    .card-category {
      display: inline-block;
      background: var(--orange);
      color: var(--white);
      padding: 8px 16px;
      border-radius: 25px;
      font-size: 0.85rem;
      font-weight: 500;
      margin-bottom: 10px;
      align-self: flex-start;
    }
    
    .card-content h3 { 
      margin: 0 0 18px; 
      font-size: 1.5rem; 
      font-weight: 700;
      color: var(--black);
      line-height: 1.4;
      font-family: "Playfair Display", serif;
    }
    
    .card-content p { 
      margin: 0 0 22px; 
      color: var(--gray); 
      font-size: 1rem;
      flex: 1;
      line-height: 1.2;
    }
    
    .meta { 
      display: flex; 
      align-items: center; 
      justify-content: space-between;
      font-size: 0.9rem; 
      color: var(--gray);
      padding-top: 10px;
      border-top: 1px solid var(--gray-light);
    }
    
    .meta div {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .meta i { 
      color: var(--orange);
      font-size: 1rem;
    }
    
    .read-more {
      color: var(--orange);
      font-weight: 500;
      font-size: 1rem;
      display: inline-flex;
      align-items: center;
      gap: 8px;

      transition: var(--transition);
    }
    
    .card:hover .read-more {
      color: var(--orange-dark);
      gap: 12px;
    }

    /* No Results Message */
    .no-results {
      grid-column: 1 / -1;
      text-align: center;
      padding: 60px 20px;
      background: var(--white);
      border-radius: 16px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      border: 2px dashed var(--orange-light);
    }
    
    .no-results i {
      font-size: 4rem;
      color: var(--orange);
      margin-bottom: 20px;
    }
    
    .no-results h3 {
      font-size: 1.8rem;
      color: var(--black);
      margin-bottom: 15px;
    }
    
    .no-results p {
      color: var(--gray);
      font-size: 1.1rem;
      max-width: 500px;
      margin: 0 auto;
    }

    /* Responsive */
    @media (max-width: 1200px){
      .blogs {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    
    @media (max-width: 992px){
      .container { 
        flex-direction: column; 
        gap: 35px;
      }
      
      .filter-container { 
        width: 100%; 
        position: relative; 
        top: 0;
      }
      
      .blogs {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .page-header {
        margin: 100px 0 50px;
      }
    }
    
    @media (max-width: 768px) {
      .page-title {
        font-size: 2.5rem;
      }
      
      .page-subtitle {
        font-size: 1.1rem;
      }
      
      .blogs {
        grid-template-columns: 1fr;
        gap: 30px;
      }
      
      .card-content {
        padding: 22px;
      }
      
      .card-content h3 {
        font-size: 1.4rem;
      }
    }
    
    @media (max-width: 576px) {
      .page-title {
        font-size: 2.2rem;
      }
      
      .page-subtitle {
        font-size: 1rem;
        padding: 12px 20px;
      }
      
      .container {
        padding: 15px;
        gap: 30px;
      }
      
      .filter-header {
        padding: 16px;
      }
      
      .filter-list li a {
        padding: 12px 16px;
      }
      
      .card-img-container {
        height: 200px;
      }
    }
  </style>
</head>
<body>

  <div class="page-header">
    <h1 class="page-title">Our Blog Collection</h1>
    <p class="page-subtitle">Explore our latest articles, insights, and stories on various topics</p>
  </div>

  <div class="container">

    <!-- Category Filter - Right Side -->
    <div class="filter-container">
      <div class="filter-header" id="filterToggle">
        <h3><i class="fa-solid fa-filter"></i> Filter by Category</h3>
        <i class="fas fa-chevron-down"></i>
      </div>
      
      <div class="filter-content" id="filterContent">
        <ul class="filter-list">
          <li>
            <a href="blog-list.php" class="<?php echo empty($filter_category) ? 'active' : ''; ?>">
              <i class="fa-solid fa-grid"></i> All Categories
            </a>
          </li>
          <?php
          $cat_result = $conn->query("SELECT id, name, slug FROM categories ORDER BY name ASC");
          while($cat = $cat_result->fetch_assoc()):
          ?>
            <li>
              <a href="blog-list.php?category=<?php echo $cat['slug']; ?>" 
                 class="<?php echo $filter_category == $cat['slug'] ? 'active' : ''; ?>">
                <i class="fa-regular fa-folder-open"></i> 
                <?php echo htmlspecialchars($cat['name']); ?>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>

    <!-- Blogs -->
    <div class="blogs">
      <?php
      if ($filter_category) {
        $stmt = $conn->prepare("SELECT b.*, c.name AS category_name, c.slug AS category_slug 
                                FROM blogs b 
                                JOIN categories c ON b.category_id = c.id 
                                WHERE c.slug = ?");
        $stmt->bind_param("s", $filter_category);
        $stmt->execute();
        $result = $stmt->get_result();
      } else {
        $result = $conn->query("SELECT b.*, c.name AS category_name, c.slug AS category_slug 
                                FROM blogs b 
                                JOIN categories c ON b.category_id = c.id 
                                ORDER BY b.created_at DESC");
      }

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()):
      ?>
        <a class="card" href="<?php echo $row['category_slug']; ?>/<?php echo $row['custom_slug']; ?>">
          <div class="card-img-container">
            <img src="uploads/<?php echo htmlspecialchars($row['cover_image']); ?>" alt="<?php echo htmlspecialchars($row['cover_image_alt']); ?>">
            <div class="card-overlay"></div>
          </div>
          <div class="card-content">
            <span class="card-category"><?php echo htmlspecialchars($row['category_name']); ?></span>
            <h3><?php echo htmlspecialchars($row['page_title']); ?></h3>
            <p><?php echo substr(strip_tags($row['cover_description']), 0, 100) . '...'; ?></p>
           
            <div class="meta">
              <div>
                <i class="fa-regular fa-calendar"></i>
                <span><?php echo date('d M Y', strtotime($row['posted_on'])); ?></span>
              </div>
              <div>
            
                <span class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></span>
              </div>
            </div>
          </div>
        </a>
      <?php 
        endwhile;
      } else {
      ?>
        <div class="no-results">
          <i class="fa-regular fa-file-alt"></i>
          <h3>No Blogs Found</h3>
          <p>We couldn't find any blog posts matching your criteria. Please try a different category.</p>
        </div>
      <?php } ?>
    </div>

  </div>

  <script>
    // Toggle filter dropdown
    document.getElementById('filterToggle').addEventListener('click', function() {
      const filterContent = document.getElementById('filterContent');
      const chevron = this.querySelector('.fa-chevron-down');
      
      filterContent.classList.toggle('active');
      chevron.classList.toggle('fa-chevron-down');
      chevron.classList.toggle('fa-chevron-up');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      const filterContainer = document.querySelector('.filter-container');
      const filterToggle = document.getElementById('filterToggle');
      
      if (!filterContainer.contains(event.target) && !filterToggle.contains(event.target)) {
        const filterContent = document.getElementById('filterContent');
        const chevron = filterToggle.querySelector('.fa-chevron-up');
        
        if (filterContent.classList.contains('active')) {
          filterContent.classList.remove('active');
          if (chevron) {
            chevron.classList.replace('fa-chevron-up', 'fa-chevron-down');
          }
        }
      }
    });
  </script>

</body>
</html>

<!-- Footer -->
<?php
include('common/footer.php');
?>