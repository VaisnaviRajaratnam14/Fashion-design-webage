<?php
session_start();
include("connection.php");

// Check if user logged in and admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Access denied. Please login as admin.'); window.location='login.php';</script>";
    exit();
}

// Fetch all products database
$query = "SELECT * FROM products1 ORDER BY id DESC";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products - Admin Panel</title>
    <link rel="stylesheet" href="product_view.css">
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
                <a href="product_view.php" class="active"><img src="img/products.png" alt="Products"> Products ▼</a>
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
        <!-- Header -->
        <div id="header">
            <div class="header-left">
                <h2>Welcome, Admin</h2>
            </div>
            <div class="header-right">
                <button onclick="logout()">Logout</button>
            </div>
        </div>

        <!-- Products Table -->
        <main>
            <section class="products-table">
                <h3>Store Products</h3>
                <?php if ($result->num_rows > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>" class="product-img"></td>
                                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    <td>Rs <?php echo number_format($row['price'], 2); ?></td>
                                    <td>
                                        <a href="update.php?id=<?php echo $row['id']; ?>" class="action-btn update">Update</a>
                                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="action-btn delete" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No products found in the store.</p>
                <?php endif; ?>
            </section>
        </main>

        <!-- Footer -->
        <footer>
            <p>© <?php echo date("Y"); ?> Vinzor Admin Panel. All rights reserved.</p>
        </footer>
    </div>

    <script>
        // Logout function
        function logout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "login.php";
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>