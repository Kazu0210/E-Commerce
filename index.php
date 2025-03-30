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
    <link rel="stylesheet" href="assets/css/navbar-backup.css">
    <title>E-Commerce | Home</title>
</head>
<body>
    <div id="dynamicmenu">

    </div>
    <div id="main-cont">
        <!-- include the navbar -->
        <?php include "includes/navbar.php"; ?>     
    </div>

    <!-- <h1 style='color: white;'>Welcome, <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : "Guest"; ?>!</h1> -->
    <script>
            document.getElementById('menubtn').addEventListener('click', function() {
                console.log('menu button clicked');
                let dynamicMenu = document.getElementById('dynamicmenu');
                let body = document.body;

                if (dynamicMenu.style.width === "100%") {
                    // Close menu and enable scrolling
                    dynamicMenu.style.width = "0";
                    body.style.overflowY = "auto"; // Allow vertical scroll
                } else {
                    // Open menu and disable scrolling
                    dynamicMenu.style.width = "100%";
                    body.style.overflowY = "hidden"; // Disable vertical scroll
                }

                dynamicMenu.style.transition = "width 0.5s ease-in-out";
            });
    </script>
</body>
</html>