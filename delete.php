<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>alert('You must log in first.'); window.location='index.php';</script>";
    exit();
}


$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "loginvs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//delete 
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $sql = "DELETE FROM products1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Product deleted successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete product"]);
    }
    $stmt->close();
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinzor Tailoring Website</title>
    <link rel="stylesheet" href="delete.css">
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
                    <li><a href="add.php">Add Product</a></li>
                    <li><a href="update.php">Update Product</a></li>
                    <li><a href="delete.php" class="active" >Delete Product</a></li>
                </ul>
            </li>
            <li><a href="login.php"><img src="img/logout.png" alt="Logout"> Logout</a></li>
        </ul>
    </div>



    <div class="main-content">
        <div class="header-container">
            <h1>Admin Dashboard</h1>
        </div>

        <div class="container">
            <h2>Product List</h2>

            <!-- Input Product ID -->
            <div style="margin-bottom: 15px;">
                <input type="number" id="product-id" placeholder="Enter Product ID" />
                <button onclick="deleteByInput()">Delete Product</button>
            </div>

            <div id="product-list">
                <?php
                $sql = "SELECT * FROM products1 ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="product" data-id="' . $row["id"] . '">';
                        echo '<span>Product ID: ' . $row["id"] . ' - ' . $row["product_name"] . '</span>';
                        echo '<button class="delete-btn" onclick="deleteProduct(' . $row["id"] . ')">Delete</button>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No products available.</p>";
                }
                ?>
            </div>
        </div>
    </div>




    <footer>
        <p>&copy; 2025 Vinzor Tailoring Website</p>
    </footer>

    <script>
        function deleteProduct(productId) {
            if (confirm("Are you sure you want to delete Product ID " + productId + "?")) {
                fetch("delete.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "delete_id=" + productId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(`.product[data-id='${productId}']`).remove();
                        alert("Product ID " + productId + " has been deleted!");
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        }

        function deleteByInput() {
            const inputField = document.getElementById("product-id");
            const productId = inputField.value.trim();

            if (productId === "") {
                alert("Please enter a Product ID!");
                return;
            }

            deleteProduct(productId);
            inputField.value = ""; 
        }
    </script>

</body>
</html>


<?php
$conn->close();
?>