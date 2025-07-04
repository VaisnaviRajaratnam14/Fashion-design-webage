<?php
session_start();
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "loginvs";

// Create connec
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connec
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check form is submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $product_name = trim($_POST['product-name']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $description = trim($_POST['description']);

    // Validate
    if (empty($product_name) || empty($price) || empty($quantity) || empty($description)) {
        die("All fields are required!");
    }

 
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $image_name = basename($_FILES["productImage"]["name"]);
    $target_file = "uploads/" . basename($_FILES["productImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  
    $allowed_types = ['jpg', 'jpeg', 'png'];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Only JPG, JPEG, and PNG files are allowed.");
    }

   
    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
        echo "File uploaded successfully.<br>";
    } else {
        die("Error uploading file.");
    }

    // Insert data into database 
    $sql = "INSERT INTO products1 (product_name, price, quantity, description, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdiss", $product_name, $price, $quantity, $description, $target_file);

    if ($stmt->execute()) {
        echo "Product added successfully!";
        header("Location: admin2.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
}

// Close conn
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinzor Tailoring Website</title>
    <link rel="stylesheet" href="add.css">
    <link rel="shortcut icon" href="img/sei1.png" type="image/png">
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar">
        <div class="sidebar-header">
            <img src="img/logo.png" alt="Vinzor" class="sidebar-logo">
            <h2>Admin Panel</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="admin2.php"><img src="img/dashboard.png" alt="Dashboard"> Dashboard</a></li>
            <li><a href="HP_1.php"><img src="img/Home.png" alt="Home"> Home</a></li>
            <li class="dropdown">
                <a href="product_view.php"><img src="img/products.png" alt="Products"> Products ▼</a>
                <ul class="dropdown-menu">
                    <li><a href="add.php" class="active" >Add Product</a></li>
                    <li><a href="update.php">Update Product</a></li>
                    <li><a href="delete.php">Delete Product</a></li>
                </ul>
            </li>
            
            <li><a href="login.php"><img src="img/logout.png" alt="Logout"> Logout</a></li>
        </ul>
    </div>


    <!-- Main Content -->
    <div class="main-content">
        <div class="header-container">
            <h1>Admin Dashboard</h1>
        </div>

        <div class="container">
            <h2>Add Product</h2>

            <form id="updateForm" action="add.php" method="POST" enctype="multipart/form-data">
              

                <label for="product-name">Product Name:</label>
                <input type="text" id="product-name" name="product-name" required>

                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>

                <label for="productImage">Upload Product Image:</label>
                <input type="file" id="productImage" name="productImage" accept="image/png, image/jpeg" required>

                <div class="preview">
                    <img id="previewImage" src="img/placeholder.png" alt="Product Preview">
                </div>

                <button type="submit">Submit Product</button>
            </form>
        </div>
    </div>


    <footer>
        <p>&copy; 2025 Vinzor Tailoring Website</p>
    </footer>

    <script>

document.addEventListener("DOMContentLoaded", function() {
    let lastScrollTop = 0;
    const header = document.querySelector(".header-container");

    window.addEventListener("scroll", function() {
        let scrollTop = window.scrollY;

        if (scrollTop > 50 && scrollTop > lastScrollTop) {
            
            header.classList.add("hidden");
        } else {
          
            header.classList.remove("hidden");
        }

        scrollTop = -10;
    });
});

       
        document.getElementById('productImage').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('previewImage').src = "img/placeholder.png";
            }
        });

      
        document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.querySelector(".sidebar");
    const menuToggle = document.querySelector(".menu-toggle");
    const mainContent = document.querySelector(".main-content");

    menuToggle.addEventListener("click", function() {
        sidebar.classList.toggle("show");
        mainContent.classList.toggle("shift");
    });
});




        document.addEventListener("scroll", function() {
    const footer = document.querySelector("footer");
    const scrollHeight = document.documentElement.scrollHeight;
    const scrollTop = document.documentElement.scrollTop;
    const clientHeight = document.documentElement.clientHeight;

    if (scrollTop + clientHeight >= scrollHeight - 10) {
        footer.style.bottom = "0";
        footer.style.opacity = "1";
    } else {
        footer.style.bottom = "-100px";
        footer.style.opacity = "0";
    }
    });

    </script>

</body>
</html>
