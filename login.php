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
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce | Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="post">
        <input type="text" name="username" id="username" placeholder="Username" maxlength='30'>
        <input type="password" name="password" id="password" placeholder="Password">

        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>