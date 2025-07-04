<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loginvs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin2.css">
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar">
        <div class="sidebar-header">
            <img src="img/logo.png" alt="Vinzor" class="sidebar-logo">
            <h2>Admin Panel</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="admin2.php" class="active" ><img src="img/dashboard.png" alt="Dashboard"> Dashboard</a></li>
            <li><a href="HP_1.php"><img src="img/Home.png" alt="Home"> Home</a></li>
            <li class="dropdown">
    <a href="product_view.php"><img src="img/products.png" alt="Products"> Products ▼</a>
    <ul class="dropdown-menu">
        <li><a href="add.php">Add Product</a></li>
        <li><a href="update.php">Update Product</a></li>
        <li><a href="delete.php">Delete Product</a></li>
    </ul>
</li>
            <li><a href="login.php"><img src="img/logout.png" alt="Logout"> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div id="main-content">
       
        <div id="header">
            <div class="header-left">
                <h2>Welcome, Admin</h2>

            </div>
            <div class="header-right">
                <button onclick="logout()">Logout</button>
            </div>
        </div>

       <main>
            <section class="dashboard">
               
                <p>Manage users, products, and orders from here.</p>
                <div class="image-grid">
                    <div class="item">
                        <img src="img/homee.png" alt="Image 1">
                        <a href="HP_1.php"><button>HOME</button></a>
                    </div>
                    <div class="item">
                        <img src="img/add.png" alt="Image 2">
                        <a href="add.php"><button>ADD NEW CATEGORY</button></a>
                    </div>
                    <div class="item">
                        <img src="img/update.png" alt="Image 3">
                        <a href="update.php"><button>UPDATE CATEGORIES</button></a>
                    </div>
                    <div class="item">
                        <img src="img/view.png" alt="Image 4">
                        <a href="product_view.php"><button>VIEW PRODUCTS </button></a>
                    </div>
                    <div class="item">
                        <img src="img/delete.png" alt="Image 5">
                        <a href="delete.php"><button>DELETE CATEGORY</button></a>
                    </div>
                    <div class="item">
                        <img src="img/switch.png" alt="Image 6">
                        <a href="logout.php"><button>LOGOUT</button></a>
                    </div>
                </div>
            </section>


        </main>
    </body>
    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Vinzor Admin Panel. All rights reserved.</p>
    </footer>

    <script>
        // Logout function
        function logout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "login.php"; // Redirect to login page
            }
        }
    </script>


</html>
