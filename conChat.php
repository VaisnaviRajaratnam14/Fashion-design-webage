<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'loginvs');

    // Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the form data into the table
    $sql = "INSERT INTO contact_messages (first_name, last_name, email, mobile, message) 
            VALUES ('$first_name', '$last_name', '$email', '$mobile', '$message')";

    if ($conn->query($sql) === TRUE) {
       
        echo "<script>
                alert('Details saved successfully!');
                document.getElementById('submit-btn').value = 'Confirm';
              </script>";
    } else {
        echo "<script>alert('Error saving details. Please try again later.'); window.history.back();</script>";
    }

   
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vinzor Tailoring Website</title>
  <link rel="stylesheet" href="contact1.css">
  <link rel="shortcut icon" href="img/sei1.png" type="image/png">




  <script>
  function validateForm() {
   
    const email = document.forms["contact-form"]["email"].value;
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email)) {
      alert("Please enter a valid email address. Only '@' is allowed as a special character.");
      return false;
    }

    // Validate phone number
    const phone = document.forms["contact-form"]["mobile"].value;
    const phonePattern = /^\+?\d{10,15}$/;
    if (!phonePattern.test(phone)) {
      alert("Please enter a valid phone number. It should contain only digits and an optional '+' at the beginning.");
      return false;
    }

    return true; 
  }
</script>

</head>

<body>
  <section id="header">
    <a href="#"><img src="img/logo.png" class="logo" alt=""></a>
    <div>
      <ul id="navbar">
        <li><a href="HP_1.php">Home</a></li>
        <li><a href="store.php">Shop</a></li>
        <li><a class="active" href="conChat.php">Contact</a></li>
        <li><a href="user_details.php">Account</a></li>
        <li><a href="about.php">About</a></li>
       
        <li> 
          <?php 
          if(isset($_SESSION['user'])): 
            echo $_SESSION['user']; ?> | <a href="logout.php">logout</a>
          <?php else: ?>
            <a href="login.php">Login</a>
          <?php endif; ?>
          
        </li>
      </ul>
    </div>
  </section>

  <div class="contactUs">
    <div class="title">
      <h2>Contact Information</h2>
    </div>
    <div class="box">
      <div class="contact form">
        <h3>Send a Message</h3>
        <form name="contact-form" method="POST" action="" onsubmit="return validateForm()">
  <div class="formBox">
    <div class="row50">
      <div class="inputBox">
        <span>First Name</span>
        <input type="text" name="first-name" placeholder="John" required>
      </div>
      <div class="inputBox">
        <span>Last Name</span>
        <input type="text" name="last-name" placeholder="Doe" required>
      </div>
    </div>
    <div class="row50">
      <div class="inputBox">
        <span>Email</span>
        <input type="email" name="email" placeholder="John@gmail.com" required>
      </div>
      <div class="inputBox">
        <span>Mobile</span>
        <input type="text" name="mobile" placeholder="+91 987 654 3210" required>
      </div>
    </div>
    <div class="row100">
      <div class="inputBox">
        <span>Message</span>
        <textarea name="message" placeholder="Write your message here...." required></textarea>
      </div>
    </div>
    <div class="row100">
      <div class="inputBox">
        <input type="submit" id="submit-btn" value="Submit">
      </div>
    </div>
  </div>
</form>

      </div>

      <!-- Contact Info and Map -->
      <div class="contact info-map">
        <div class="info">
          <h3>Contact Info</h3>
          <div class="infoBox">
            <div class="infoItem">
              <span><img src="img/location.png" alt="Location icon"></span>
              <p>Headquarters, Colombo.</p>
            </div>
            <div class="infoItem">
              <span><img src="img/email.png" alt="Email icon"></span>
              <a href="mailto:hujhuhu@gmail.com">vaisnaviboss27@gmail.com</a>
            </div>
            <div class="infoItem">
              <span><img src="img/phone.png" alt="Phone icon"></span>
              <a href="tel:0768738378">0768738378</a>
            </div>
            <ul class="sci">
              <li><a href="#"><img src="img/sf.png" alt="Facebook"> Facebook</a></li>
              <li><a href="#"><img src="img/st.png" alt="Twitter"> Twitter</a></li>
              <li><a href="#"><img src="img/si.png" alt="Instagram"> Instagram</a></li>
            </ul>
          </div>
        </div>

        <div class="map">
          <h3>Our Location</h3>
          <div class="mapBox">
            <iframe src="https://www.google.com/maps/embed?pb=..." width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
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
