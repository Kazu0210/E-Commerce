<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['login'])) {
        header("Location: login.php");
        exit();
    } elseif (isset($_POST['register'])) {
        header("Location: register.php");
        exit();
    } elseif (isset($_POST['logout'])) {
        echo "<script>
            var confirmLogout = confirm('Are you sure you want to log out?');
            if (confirmLogout) {
                window.location.href = 'logout.php';
            }
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>E-Commerce | Home</title>
</head>
<body>
    <!-- include the navbar -->
    <?php include "includes/navbar.php"; ?> 
    <div id="categories">
        <nav>
            <ul>
                <li id="homeLink"><a href="#">Home</a></li>
                <li><a href="#">Smartphones & Accessories</a></li>
                <li><a href="#">Laptops & Accessories</a></li>
                <li><a href="#">Audio & Wearables</a></li>
                <li><a href="#">Gaming Gear</a></li>
                <li><a href="#">Smart Home Devices</a></li>
            </ul>
        </nav>
    </div>

    <!-- <h1 style='color: white;'>Welcome, <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : "Guest"; ?>!</h1> -->

</body>
</html>
