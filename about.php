<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vinzor Tailoring Website</title>
  <link rel="stylesheet" href="about.css">
  <link rel="shortcut icon" href="img/sei1.png" type="image/png">
</head>
<body>
 
  <section id="header">
    <a href="#"><img src="img/logo.png" class="logo" alt="Vinzor Tailoring Logo"></a>
    <nav>
      <ul id="navbar">
        <li><a  href="HP_1.php">Home</a></li>
        <li><a href="store.php">Shop</a></li>
        <li><a href="conChat.php">Contact</a></li>
        <li><a href="user_details.php">Account</a></li>
        <li><a class="active" href="about.php">About</a></li>
        


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

 
  <header>
    <h1>About Us</h1>
    <p>At our Vinzor, we focus on providing quality, sustainability, and innovation in the fashion industry. Our aim is to inspire confidence and make a positive impact on our customers and the environment.</p>
  </header>

  <!-- Vision and Mission -->
  <section class="vision-mission">
    <h2>Our Mission & Vision </h2>
    <div class="row">
      
      <div class="column">
        <h3>Our Mission</h3>
        <img src="img/v1.png" alt="Mission Image">
        <p>To revolutionize the fashion industry by combining exceptional craftsmanship with sustainable practices, ensuring every stitch contributes to a better future for the planet and its people.</p>
      </div>

      <div class="column">
        <h4>Our Vision</h4>
        <img src="img/suit.png" alt="Vision Image">
        <p>To lead the industry in creating innovative, eco-friendly fashion solutions that empower individuals and protect our environment for generations to come.</p>
      </div>
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
</body>
</html>
