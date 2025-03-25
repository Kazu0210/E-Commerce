<?php
include "db.php"; // Ensure this file correctly connects to the database

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['login'])) {
        // Get data from the form
        $username = trim($_POST['username']);
        $fetchedPassword = $_POST['password'];

        if (!empty($username) && !empty($fetchedPassword)) {
            // Use a prepared statement to prevent SQL injection
            $sql = "SELECT user_id, username, password FROM user_tbl WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $storedPassword = $row['password']; // This should be a hashed password from the database

                // Verify password (assuming it's hashed using password_hash())
                if (password_verify($fetchedPassword, $storedPassword)) {
                    // Start session
                    session_start();
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];

                    // Redirect to dashboard
                    header("Location: index.php");
                    exit;
                } else {
                    echo "❌ Invalid username or password.";
                }
            } else {
                echo "❌ No user found with that username.";
            }

            $stmt->close();
        } else {
            echo "❌ Please enter both username and password.";
        }
    }
    elseif (isset($_POST['backtohome'])) {
        header("Location: index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>E-Commerce | Login</title>
</head>
<body>
    <div id="main-cont">
        <div id="loginForm">
            <form action="" method="post">
                <div id="username-cont">
                    <p id="username-text">Username</p>
                    <input type="text" name="username" id="username" maxlength='30'>
                </div>

                <div id="password-cont">
                    <p id="password-text">Password</p>
                    <input type="password" name="password" id="password">
                </div>
        
                <div id="forgotPass-cont">
                    <button type="submit" name="login" id="loginBtn">LOGIN</button>
                    <a href="">Forgot password</a>
                </div>

                <a href="" id="registerLink">Don't have an account? Click here.</a>

                <p style="text-align: center; color: #767678">or</p>
                <button type="submit" name="backtohome" id="backtohomeBtn">Back to home</button>
            </form>
        </div>
    </div>
</body>
</html>