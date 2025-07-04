<?php
session_start();
include("connection.php");


if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
    echo "<script>alert('Invalid product.'); window.location='store.php';</script>";
    exit();
}

$product_id = intval($_POST['product_id']);


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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $quantity = intval($_POST['quantity']);
    $size = htmlspecialchars($_POST['size']);
    $color = htmlspecialchars($_POST['color']); 

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    
    $product_exists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id && $item['size'] == $size && $item['color'] == $color) {
            $item['quantity'] += $quantity;
            $product_exists = true;
            break;
        }
    }

   
    if (!$product_exists) {
        $cart_item = [
            'product_id' => $product_id,
            'product_name' => $product['product_name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'quantity' => $quantity,
            'size' => $size,
            'color' => $color
        ];
        $_SESSION['cart'][] = $cart_item;
    }

    echo "<script>alert('Product proceed successfully!'); window.location='store.php';</script>";
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
    <title><?php echo htmlspecialchars($product['product_name']); ?> - Add to Cart</title>
    <link rel="stylesheet" href="addcard.css">
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
                        echo "<script>alert('Your account is not login, Please login...'); window.location='login.php';</script>";
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </section>

    <!-- Add to Cart Section -->
    <div class="cart-container">
        <div class="product-image">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
        </div>
        <div class="product-info">
            <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <h3>Price: Rs <?php echo number_format($product['price'], 2); ?></h3>

            <form method="POST" action="">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                
                <div class="form-group">
                    <label for="size">Size:</label>
                    <select id="size" name="size" required>
                        <option value="S">Small</option>
                        <option value="M">Medium</option>
                        <option value="L">Large</option>
                        <option value="XL">Extra Large</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="color">Color:</label>
                    <select id="color" name="color" required>
                        <option value="Red">Red</option>
                        <option value="Black">Black</option>
                        <option value="Pink">Pink</option>
                        <option value="Green">Green</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" required>
                </div>

                <button type="submit" name="add_to_cart" class="add-cart-btn">Buy Now</button>
            </form>
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
                <p>Sign up for exclusive offers:</p>
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
</body>
</html>