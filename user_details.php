<?php
session_start();
include("connection.php");



// Function fetch user 
function getUserDetails($user_id) {
    global $host, $dbname, $username, $password;
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT username, email, created_at FROM users WHERE id = :id");
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return ['error' => $e->getMessage()];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link rel="stylesheet" href="user_details.css">
    <link rel="shortcut icon" href="img/sei1.png" type="image/png">
</head>
<body>
    <!-- Header -->
    <section id="header">
        <a href="#"><img src="img/logo.png" class="logo" alt="Vinzor Tailoring Logo"></a>
        <nav>
            <ul id="navbar">
                <li><a class="active" href="HP_1.php">Home</a></li>
                <li><a href="store.php">Shop</a></li>
                <li><a href="conChat.php">Contact</a></li>
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
        </nav>
    </section>

    <div class="container">
        <h1>Account Settings</h1>
        
        <!-- User Details-->
        <div class="user-details">
            <h2>User Information</h2>

            <?php
            if(isset($_SESSION['user'])): ?>
              <p><b> User Name : </p></b> 
              <?php 
              echo $_SESSION['user']; ?>
                <p><b> Email Address : </p></b>
                <?php
                 echo $_SESSION['email'];
            ?> 
            <?php else: ?>
                echo "<script>alert('Your account is not login, Please login...'); window.location='login.php';</script>"; <!--redirect login page-->
                    <?php endif; ?>
            
        </div>

        <!-- Settings Form-->
        <div class="settings-form">
            <h2>Update Account</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                
                <div class="form-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password">
                </div>
                <button type="submit" class="submit-btn">Update Settings</button>
            </form>
            <?php echo isset($message) ? $message : ''; ?>
        </div>
    </div>
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

<style>
    /* user_details.css */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f0f2f5;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

#header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 80px;
    background: #e3e6f3;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
    z-index: 999;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%; 
}

#navbar {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: nowrap;
}

#navbar li {
    list-style: none;
    padding: 0 20px;
    position: relative;
}

#navbar li a {
    text-decoration: none;
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
    transition: 0.3s ease;
}

#navbar li a:hover,
#navbar li a.active {
    color: #088178;
}

#navbar li a.active::after,
#navbar li a:hover::after {
    content: "";
    width: 30%;
    height: 2px;
    background: #088178;
    position: absolute;
    bottom: -4px;
    left: 20px;
}

.container {
    width: 600px;
    margin: 100px auto 20px;
    background: white;
    padding: 60px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
 .footer {
  background-color: #222;
  color: #fff;
  padding: 20px 0;
  font-family: Arial, sans-serif;
}

.footer-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  max-width: 1200px;
  margin: 0 auto;
  padding: 10px;
}

.footer-section {
  flex: 1 1 200px;
  margin: 10px;
}

.footer-section h4 {
  margin-bottom: 15px;
  font-size: 16px;
  color: #f5a623;
}

.footer-section ul {
  list-style: none;
  padding: 0;
}

.footer-section ul li {
  margin: 5px 0;
}

.footer-section ul li a {
  color: #fff;
  text-decoration: none;
}

.footer-section ul li a:hover {
  text-decoration: underline;
}


h1 {
    color: #1a73e8;
    text-align: center;
    margin-bottom: 20px;
}

h2 {
    color: #333;
    margin-bottom: 15px;
}

.user-details {
    margin-bottom: 30px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 5px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.submit-btn {
    background-color: #1a73e8;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}

.submit-btn:hover {
    background-color: #1557b0;
}

.footer {
    background-color: #222;
    color: #fff;
    padding: 20px 0;
    font-family: Arial, sans-serif;
  }
  
  .footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    max-width: 1200px;
    margin: 0 auto;
    padding: 10px;
  }
  
  .footer-section {
    flex: 1 1 200px;
    margin: 10px;
  }
  
  .footer-section h4 {
    margin-bottom: 15px;
    font-size: 16px;
    color: #f5a623;
  }
  
  .footer-section ul {
    list-style: none;
    padding: 0;
  }
  
  .footer-section ul li {
    margin: 5px 0;
  }
  
  .footer-section ul li a {
    color: #fff;
    text-decoration: none;
  }
  
  .footer-section ul li a:hover {
    text-decoration: underline;
  }
  .footer-bottom{
    align-items:center;
  }
    </style>