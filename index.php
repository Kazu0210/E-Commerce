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
        session_unset();
        session_destroy();
        header("Location: index.php"); // Redirect to homepage after logout
        exit();
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
    <nav id="navbar">
        <!-- <div id="logo">&lt;Tech & Gadgets/&gt;</div> -->
        <div id="logo-cont">
            <img src="assets/images/tech-gadgets-logo.png" alt="" id="logo-img">
        </div>
        <div id="searchBar">
            <form action="" method="post">
                <input type="text" name="searchInput" id="searchInput" placeholder="Search here">
                <button type="submit" name="searchBtn" id="searchBtn">
                    <img src="assets/images/search-white.png" alt="search-icon" id="searchIcon">
                </button>
            </form>
        </div>
        <div id="buttons">
            
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <?php if (isset($_SESSION['username'])): ?>
                    <button name="cartBtn" id="cartBtn">
                        <img src="assets/images/cart-white.png" alt="cart-icon" id="cartIcon">
                    </button>
        
                    <button name="userBtn" id="userBtn">
                        <img src="assets/images/user-white.png" alt="user-icon" id="userIcon">
                    </button>
                    <button type="submit" name="logout" id="logoutBtn">Logout</button>
                <?php else: ?>
                    <button type="submit" name="login" id="loginBtn">Login</button>
                    <button type="submit" name="register" id="registerBtn">Register</button>
                <?php endif; ?>
            </form>

        </div>
    </nav>
    
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


    <script src="assets/js/index.js"></script>
</body>
</html>
