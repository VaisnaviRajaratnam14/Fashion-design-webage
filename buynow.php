<?php
session_start();
include("connection.php"); // Database connection file

// Check if product ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid product.'); window.location='store.php';</script>";
    exit();
}

$product_id = intval($_GET['id']); // Convert to integer to prevent SQL injection

// Fetch product details from the database
$query = "SELECT * FROM products1 WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $product = $result->fetch_assoc();
} else {
    echo "<script>alert('Product not found.'); window.location='store.php';</script>";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_name']); ?> - Buy Now</title>
    <link rel="stylesheet" href="buynow.css">
    <link rel="shortcut icon" href="img/sei1.png" type="image/png">
</head>
<body>
    <!-- Header -->
    <section id="header">
        <a href="#"><img class="logo" src="img/logo.png" alt="Vinzor Tailoring Logo"></a>
        <nav>
            <ul id="navbar">
                <li><a href="HP_1.php">Home</a></li>
                <li><a href="store.php">Shop</a></li>
                <li><a href="conChat.php">Contact</a></li>
                <li><a href="user_details.php">Account</a></li>
                <li><a href="about.php">About</a></li>
               
                <li>
                    <?php 
                    if(isset($_SESSION['user'])): 
                        echo $_SESSION['user']; ?> | <a href="logout.php">logout</a>
                    <?php else: ?>
                       
                echo "<script>alert('Your account is not login, Please login...'); window.location='login.php';</script>"; <!--redirect login page-->
                    
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </section>

    <!-- Product Details -->
    <div class="buy-now-container">
        <div class="product-image">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
        </div>
        <div class="product-info">
            <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <h3>Price: Rs <?php echo number_format($product['price'], 2); ?></h3>
            
            <form method="POST" action="">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1" required>
                <button type="button" class="proceed-btn" onclick="confirmOrder()">Proceed</button>
            </form>
        </div>
    </div>
    </body>

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
            <p>© <?php echo date("Y"); ?> Vinzor Tailoring. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        function confirmOrder() {
            alert("Order placed successfully!");
            window.location.href = "store.php"; // Redirect back to store page
        }
    </script>
</html>