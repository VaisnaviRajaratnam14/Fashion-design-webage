<?php
session_start();
include("connection.php");

if (isset($_SESSION['user'])) {
    header("Location: user_details.php");
    exit();
}

// Signup
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Check if email assign admin in database
    $adminCheckQuery = "SELECT * FROM admins WHERE email = ?";
    $stmtAdmin = $conn->prepare($adminCheckQuery);
    $stmtAdmin->bind_param("s", $email);
    $stmtAdmin->execute();
    $resultAdmin = $stmtAdmin->get_result();

    
    $role = ($resultAdmin->num_rows > 0) ? 'admin' : 'user';

    // Check if email already exists users table
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $stmtCheck = $conn->prepare($checkEmailQuery);
    $stmtCheck->bind_param("s", $email);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        echo "<script>alert('Email already registered. Try logging in.');</script>";
    } else {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        $insertUserQuery = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($insertUserQuery);
        $stmtInsert->bind_param("ssss", $username, $email, $hashedPassword, $role);

        if ($stmtInsert->execute()) {
            echo "<script>alert('Signup Successful! You can now log in.'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Error: Could not register.');</script>";
        }
    }
}

// Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];

            if ($user['role'] == 'admin') {
                echo "<script>alert('Admin Login Successful!'); window.location='admin2.php';</script>";
            } else {
                echo "<script>alert('User Login Successful!'); window.location='HP_1.php';</script>";
            }
        } else {
            echo "<script>alert('Invalid email or password.');</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinzor Tailoring Website</title>
    <link rel="stylesheet" href="login2.css">
    <link rel="shortcut icon" href="img/sei1.png" type="image/png">
</head>
<body>

    <section id="header">
        <a href="#"><img src="img/logo.png" class="logo" alt="Vinzor Tailoring Logo"></a>
        <nav>
            <ul id="navbar">
                <li><a  href="HP_1.php">Home</a></li>
                <li><a  href="store.php">Shop</a></li>
                <li><a href="conChat.php">Contact</a></li>
                <li><a  href="user_details.php">Account</a></li>
                <li><a href="about.php">About</a></li>

                <li> 
          <?php 
          if(isset($_SESSION['user'])): 
            echo $_SESSION['user']; ?> | <a href="logout.php">logout</a>
          <?php else: ?>
            <a class="active" href="login.php">Login</a>
          <?php endif; ?>
          
        </li>
    </section>

    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        
        <div class="signup">
            <form method="POST" action="">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="username" placeholder="User name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="signup">Sign up</button>
            </form>
        </div>

        <div class="login">
            <form method="POST" action="">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>

</body>
</html>
