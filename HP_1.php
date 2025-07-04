<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vinzor Tailoring Website</title>
  <link rel="stylesheet" href="hp.css">
  <link rel="shortcut icon" href="img/sei1.png" type="image/png">
</head>
<body>
  <!-- Header-->
  <section id="header">
    <a href="#"><img src="img/logo.png" class="logo" alt="Vinzor Tailoring Logo"></a>
    <nav>
      <ul id="navbar">
        <li><a class="active" href="HP_1.php">Home</a></li>
        <li><a href="store.php">Shop</a></li>
        <li><a href="conChat.php">Contact</a></li>
        <li><a href="user_details.php">Account</a></li>
        <li><a href="about.php">About</a></li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li><a href="admin2.php">Admin Dashboard</a></li>
                <?php endif; ?>
        <li> 
          <?php 
          if(isset($_SESSION['user'])): 
            echo $_SESSION['user']; ?> | <a href="logout.php">logout</a>
          <?php else: ?>
            <a href="login.php">Login</a>
          <?php endif; ?>
          
        </li>
        
        
       

        
      </ul>
    </nav>
  </section>

  <section id="hero">
    <h4>Trade-in-offer</h4>
    <h2>Super Designs</h2>
    <h1>In All Models</h1>
    <p>Your Style, Your Design</p>
    <button >Order Now</button>
  </section>

  <!-- Features-->
  <section id="feature" class="section-p1">
    <div class="fe-box">
      <img src="img/free.png" alt="Free Shipping">
      <h6>Free Shipping</h6>
    </div>
    <div class="fe-box">
      <img src="img/online1.png" alt="Online Shopping">
      <h6>Online Shopping</h6>
    </div>
    <div class="fe-box">
      <img src="img/save.png" alt="Save Money">
      <h6>Save Money</h6>
    </div>
    <div class="fe-box">
      <img src="img/pro.png" alt="Promotions">
      <h6>Promotions</h6>
    </div>
    <div class="fe-box">
      <img src="img/sell.png" alt="Happy Sell">
      <h6>Happy Sell</h6>
    </div>
    <div class="fe-box">
      <img src="img/24-7hour.png" alt="24/7 Support">
      <h6>24/7 Support</h6>
    </div>
  </section>

  <!-- Products-->
  <section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>New Modern Designs</p>
    <div class="pro-container">
      <div class="pro">
        <img src="img/k1.avif" alt="Kids Wear">
        <div class="des">
          <h5>Kids</h5>
          <h4>Born Baby - 5 Years</h4>
        </div>
      </div>
      <div class="pro">
        <img src="img/p6.jpg" alt="Child Wear">
        <div class="des">
          <h5>Child</h5>
          <h4>6 Years - 12 Years</h4>
        </div>
      </div>
      <div class="pro">
        <img src="img/l3.webp" alt="Girls Wear">
        <div class="des">
          <h5>Girls</h5>
        </div>
      </div>
      <div class="pro">
        <img src="img/pb1.jpg" alt="Boys Wear">
        <div class="des">
          <h5>Boys</h5>
        </div>
      </div>
    </div>
  </section>

  <!-- Banner-->
  <section id="banner" class="section-m1">
    <h1>Offers for NewYear 2025!!!!</h1>
    <h2>Up to <span>10% Discount</span> on All</h2>
    <button class="normal">Explore More</button>
  </section>

  <!-- SBanner-->
  <section id="sm-banner" class="section-p1">
    <div class="banner-box">
      <h4>Crazy Deals</h4>
      <h2>Upcoming Christmas</h2>
      <span>GIFTS</span>
      <button class="white">Learn More</button>
    </div>
    <div class="banner-box banner-box2">
      <h4>Deals</h4>
      <h2>Upcoming Seasons</h2>
      <span>Embridory</span>
      <button class="white">Learn More</button>
    </div>
  </section>

  <!-- Footer-->
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-section">
        <h4>About Us</h4>
        <ul>
          <li><a href="#">Company Info</a></li>
          <li><a href="#">Careers</a></li>
          <li><a href="#">Press</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h4>Customer Service</h4>
        <ul>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Returns & Refunds</a></li>
          <li><a href="#">Shipping Info</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h4>Follow Us</h4>
        <div class="social-icons">
          <a href="#" class="icon">Facebook</a>
          <a href="#" class="icon">Instagram</a>
          <a href="#" class="icon">Twitter</a>
        </div>
      </div>
      <div class="footer-section">
        <h4>Newsletter</h4>
        <p>Sign up for exclusive offers and updates:</p>
        <form>
          <input type="email" placeholder="Your email" required>
          <button type="submit">Subscribe</button>
        </form>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© 2024 Vinzor Tailoring. All Rights Reserved.</p>
    </div>
  </footer>
  <script src="script.js"></script>
</body>
</html>
