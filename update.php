<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinzor Tailoring Website</title>
    <link rel="stylesheet" href="update.css">
    <link rel="shortcut icon" href="img/sei1.png" type="image/png">
</head>
<body>

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
                    <li><a href="add.php">Add Product</a></li>
                    <li><a href="update.php" class="active" >Update Product</a></li>
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
            <h2>Update Product</h2>

            <form id="updateForm" action="update-product.php" method="POST" enctype="multipart/form-data">
                <label for="product-id">Product ID:</label>
                <input type="text" id="product-id" name="product-id" required>

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

                <button type="submit">Update Product</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Vinzor Admin Panel. All rights reserved.</p>
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

                lastScrollTop = scrollTop;
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
    </script>

</body>
</html>
