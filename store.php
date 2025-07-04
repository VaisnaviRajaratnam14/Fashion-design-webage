<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loginvs";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinzor Tailoring Website</title>
    <link rel="stylesheet" href="store.css">
    <link rel="shortcut icon" href="img/sei1.png" type="image/png">
</head>

<body>
    <section id="header">
        <a href="#"><img class="logo" src="img/logo.png"></a>
        <nav>
            <ul id="navbar">
                <li><a  href="HP_1.php">Home</a></li>
                <li><a class="active" href="store.php">Shop</a></li>
                <li><a href="conChat.php">Contact</a></li>
                <li><a  href="user_details.php">Account</a></li>
                <li><a href="about.php">About</a></li>
               

                <li> 
          <?php 
          if(isset($_SESSION['user'])): 
            echo $_SESSION['user']; ?> | <a href="logout.php">logout</a>
          <?php else: ?>
            <a href="login.php">Login</a>
          <?php endif; ?>
          
        </li>
                 <!-- Cart Icon -->
            </ul>
        </nav>
    </section>

    <div class="gallery"></div>
    
    <div class="products">
        <?php
        $sql = "SELECT * FROM products1 ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                
                $image = !empty($row["image"]) ? htmlspecialchars($row["image"]) : "img/placeholder.png";
        ?>

                <div class="content">
                    <img src="<?php echo $image; ?>" alt="<?php echo htmlspecialchars($row["product_name"]); ?>">
                    <h3><?php echo htmlspecialchars($row["product_name"]); ?></h3>
                    <p><?php echo htmlspecialchars($row["description"]); ?></p>
                    <h6>Rs <?php echo number_format($row["price"], 2); ?></h6>

                    
                    <form method="POST" action="addcard.php">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['product_name']); ?>">
                        <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                        <input type="hidden" name="image" value="<?php echo htmlspecialchars($row['image']); ?>">
                        
                        <!-- Quantity Input default is 1 -->
                        <input type="number" name="quantity" value="1" min="1" max="100">
                        
                        <button class="Add" onclick="location.href='addcard.php?id=<?php echo $row["id"]; ?>'">Add to Cart</button>
                    </form>
                    
                    <button class="buy1" onclick="location.href='buynow.php?id=<?php echo $row["id"]; ?>'">Buy Now</button>
                </div>

        <?php
            }
        } else {
            echo "<p>No products available.</p>";
        }
        ?>
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

<?php

$conn->close();
?>
