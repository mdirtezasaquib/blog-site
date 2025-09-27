<?php
include('common/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page Title -->
    <title>About The Author | Blogging Website</title>

    <!-- Meta Description & Keywords -->
    <meta name="description" content="Learn about the author of our blogging website, their journey, expertise, and insights.">
    <meta name="keywords" content="author, blogging, biography, expertise, insights">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.example.com/about-the-author">

    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <!-- Open Graph -->
    <meta property="og:title" content="About The Author | Blogging Website">
    <meta property="og:description" content="Learn about the author of our blogging website, their journey, expertise, and insights.">
    <meta property="og:image" content="https://www.example.com/images/author-og.jpg">
    <meta property="og:url" content="https://www.example.com/about-the-author">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Blogging Website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="About The Author | Blogging Website">
    <meta name="twitter:description" content="Learn about the author of our blogging website, their journey, expertise, and insights.">
    <meta name="twitter:image" content="https://www.example.com/images/author-og.jpg">

    <!-- Schema / JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Person",
      "name": "Author Name",
      "url": "https://www.example.com/about-the-author",
      "description": "Learn about the author of our blogging website, their journey, expertise, and insights.",
      "sameAs": [
        "https://www.linkedin.com/in/author",
        "https://twitter.com/author"
      ]
    }
    </script>

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        
       
      
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Section */
        .page-header {
          
            padding: 80px 0 60px;
            text-align: center;
            color: var(--orange);
            margin-bottom: 60px;
        }
        
        .page-title {
            font-family: "Playfair Display", serif;
            font-size: 2.8rem;
            font-weight: 600;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        
      
        /* About Content */
        .about-content {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            margin-bottom: 60px;
        }
        
        .author-image {
            flex: 1;
            min-width: 300px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            height: fit-content;
        }
        
        .author-image img {
            width: 100%;
            height: auto;
            display: block;
            transition: var(--transition);
        }
        
        .author-image:hover img {
            transform: scale(1.05);
        }
        
        .author-info {
            flex: 2;
            min-width: 300px;
        }
        
        .author-info h2 {
            font-family: "Playfair Display", serif;
            font-size: 2.2rem;
            color: var(--orange);
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .author-info h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: var(--orange);
            border-radius: 2px;
        }
        
        .author-info p {
            margin-bottom: 25px;
            font-size: 1.1rem;
            color: var(--black);
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: var(--orange);
            color: var(--white);
            border-radius: 50%;
            text-decoration: none;
            transition: var(--transition);
            font-size: 1.2rem;
        }
        
        .social-links a:hover {
            background: var(--black);
            transform: translateY(-5px);
        }
        
        /* Details Section */
        .details-section {
            margin-bottom: 60px;
        }
        
        .section-title {
            font-family: "Playfair Display", serif;
            font-size: 2rem;
            color: var(--orange);
            margin-bottom: 40px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--orange);
            border-radius: 2px;
        }
        
        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .detail-card {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: var(--transition);
            border-top: 5px solid var(--orange);
        }
        
        .detail-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(243, 118, 0, 0.2);
        }
        
        .detail-card h3 {
            font-size: 1.5rem;
            color: var(--orange);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .detail-card h3 i {
            font-size: 1.8rem;
        }
        
        .divider {
            height: 2px;
            background: var(--gray-light);
            margin: 20px 0;
        }
        
        .detail-item {
            margin-bottom: 20px;
        }
        
        .detail-item h4 {
            font-size: 1.2rem;
            color: var(--black);
            margin-bottom: 8px;
        }
        
        .detail-item .date {
            color: var(--orange);
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }
        
        .detail-item p {
            color: var(--gray);
            margin-bottom: 0;
        }
        
        .awards-list {
            list-style: none;
        }
        
        .awards-list li {
            margin-bottom: 15px;
            padding-left: 25px;
            position: relative;
        }
        
        .awards-list li:before {
            content: "★";
            color: var(--orange);
            position: absolute;
            left: 0;
            top: 0;
            font-size: 1.2rem;
        }
        
        /* Call to Action */
        .cta-section {
            background: linear-gradient(to right, rgba(243, 118, 0, 0.9), rgba(255, 154, 64, 0.8));
            padding: 60px 0;
            text-align: center;
            color: var(--white);
            border-radius: 20px;
            margin-bottom: 60px;
        }
        
        .cta-section h2 {
            font-family: "Playfair Display", serif;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        
        .cta-section p {
            max-width: 600px;
            margin: 0 auto 30px;
            font-size: 1.2rem;
        }
        
        .btn {
            display: inline-block;
            background: var(--white);
            color: var(--orange);
            padding: 15px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: var(--transition);
            border: 2px solid transparent;
        }
        
        .btn:hover {
            background: transparent;
            color: var(--white);
            border-color: var(--white);
            transform: translateY(-5px);
        }
        
      
        /* Responsive Design */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2.5rem;
            }
            
            .author-image, .author-info {
                flex: 1 1 100%;
            }
            
            .about-content {
                gap: 30px;
            }
            
            .author-info h2 {
                font-size: 1.8rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .detail-card {
                padding: 20px;
            }
            
            .cta-section h2 {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 480px) {
            .page-title {
                font-size: 2rem;
            }
            
            .page-header {
                padding: 60px 0 40px;
            }
            
            .breadcrumb {
                flex-direction: column;
                gap: 10px;
            }
            
            .breadcrumb li:not(:last-child):after {
                display: none;
            }
            
            .social-links {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">About The Author</h1>
            
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="container">
        <!-- About Content -->
        <section class="about-content">
            <div class="author-image">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=600&q=80" alt="Author Image">
            </div>
            
            <div class="author-info">
                <h2>Hello, I'm Alex Johnson</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi amet, ultrices scelerisue cras. Tincidunt hendrerit egestas venenatis risus sit nunc. Est esgilt non in ipsum lectaaus adipiscing et enim porttitor. Dui ultrices et volud eetpat nunc, turpis rutrum elit vestibulutim ipsum. Arcu fringilla duis vitae mos dscilis duicras interdum purus cursus massa metus.</p>
                
                <p>Acc umsan felaais, egsdvet nisi, viverra turpis fermentum sit suspt bafedfio ndisse fermentum consectetur. Facilisis feugiat tristque orci tempor sed masd fosssa tristique ultrices sodales. Augue est sapien elementum facilisis. Enim tincidnt cras interdum purus ndisse. morbi quis nunc.</p>
                
                <p>Et dolor placerat tempus risus nunc urna, nunc a. Matlis viverra ut sapidaem enim sed tortor. Matlis gravida fusce cras interdum purus cursus massa metus. Acc umsan felaais, eget nisi, viverra turpis fermentum sit suspt bafedfio ndisse. morbi quis nunc, at arcu quam facilisi.</p>
                
                <div class="social-links">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
        </section>
        
        <!-- Details Section -->
        <section class="details-section">
            <h2 class="section-title">My Background</h2>
            
            <div class="details-grid">
                <!-- Education -->
                <div class="detail-card">
                    <h3><i class="fas fa-graduation-cap"></i> Formal Education</h3>
                    <div class="divider"></div>
                    
                    <div class="detail-item">
                        <h4>Southeast University</h4>
                        <span class="date">1985 - 1991</span>
                        <p>gravida nibh velvelli auctor alimo quiet menean solii</p>
                    </div>
                    
                    <div class="detail-item">
                        <h4>Northeast University</h4>
                        <span class="date">1985 - 1991</span>
                        <p>gravida nibh velvelli auctor alimo quiet menean solii</p>
                    </div>
                </div>
                
                <!-- Experience -->
                <div class="detail-card">
                    <h3><i class="fas fa-briefcase"></i> Work Experience</h3>
                    <div class="divider"></div>
                    
                    <div class="detail-item">
                        <h4>Senior Content Writer</h4>
                        <span class="date">2015 - Present</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi amet, ultrices scelerisue cras.</p>
                    </div>
                    
                    <div class="detail-item">
                        <h4>Editorial Director</h4>
                        <span class="date">2010 - 2015</span>
                        <p>Tincidunt hendrerit egestas venenatis risus sit nunc. Est esgilt non in ipsum lectaaus.</p>
                    </div>
                </div>
                
                <!-- Awards -->
                <div class="detail-card">
                    <h3><i class="fas fa-award"></i> Awards & Recognition</h3>
                    <div class="divider"></div>
                    
                    <ul class="awards-list">
                        <li><strong>Best Writer Award</strong> - Best New Novel (2020)</li>
                        <li><strong>Content Excellence Award</strong> - Best Article (2019)</li>
                        <li><strong>Reader's Choice Award</strong> - Best Book (2018)</li>
                        <li><strong>Digital Content Award</strong> - Best Blog (2017)</li>
                    </ul>
                </div>
            </div>
        </section>
        
        <!-- Call to Action -->
        <section class="cta-section">
            <h2>Let's Connect!</h2>
            <p>Have questions or want to discuss a project? Feel free to reach out.</p>
            <a href="#" class="btn">Get In Touch</a>
        </section>
    </main>
    
   
    <?php
include('common/footer.php');
?>
</body>
</html>