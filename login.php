<?php
session_start(); // Start session at the beginning
include "db.php"; // Ensure this file correctly connects to the database

$notifMessage = "";
$notifType = "";

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
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];

                    // Success Notification
                    $notifMessage = "✅ Login successful! Redirecting...";
                    $notifType = "success";

                    echo "<script>
                        setTimeout(() => { window.location.href = 'index.php'; }, 2000);
                    </script>";
                } else {
                    $notifMessage = "❌ Invalid username or password.";
                    $notifType = "error";
                }
            } else {
                $notifMessage = "❌ No user found with that username.";
                $notifType = "error";
            }
            $stmt->close();
        } else {
            $notifMessage = "❌ Please enter both username and password.";
            $notifType = "error";
        }
    }
    elseif (isset($_POST['backtohome'])) {
        header("Location: index.php");
        exit;
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
    <div class="notif-container" id="notif-container"></div>
    
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

                <a href="register.php" id="registerLink">Don't have an account? Click here.</a>

                <p style="text-align: center; color: #767678">or</p>
                <button type="submit" name="backtohome" id="backtohomeBtn">Back to home</button>
            </form>
        </div>
    </div>

    <script>
        function showNotification(message, type = "success") {
            const container = document.getElementById("notif-container");

            // Create notification
            const notif = document.createElement("div");
            notif.classList.add("notif", type);
            notif.innerHTML = `<strong>${message}</strong>`;

            container.appendChild(notif);

            // Hide after 3 seconds with fade effect
            setTimeout(() => {
                notif.classList.add("hide");
                setTimeout(() => notif.remove(), 1500);
            }, 800);
        }

        // Show notification from PHP if set
        <?php if (!empty($notifMessage)): ?>
            showNotification("<?php echo $notifMessage; ?>", "<?php echo $notifType; ?>");
        <?php endif; ?>
    </script>

    <style>
        .notif-container {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 250px;
            z-index: 1000;
        }
        .notif {
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            background-color: #f0f0f0;
            opacity: 1;
            transition: opacity 1.5s ease-out;
        }
        .notif.success { background-color: #28a745; color: white; }
        .notif.error { 
            background-color: #dc3545;
            color: white;
        }
        .notif.hide { opacity: 0; }
    </style>
</body>
</html>
