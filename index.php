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
    <title>E-Commerce | Home</title>
</head>
<body>
    <h1>Welcome, <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : "Guest"; ?>!</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <?php if (isset($_SESSION['username'])): ?>
            <button type="submit" name="logout">Logout</button>
        <?php else: ?>
            <button type="submit" name="login">Login</button>
            <button type="submit" name="register">Register</button>
        <?php endif; ?>
    </form>
</body>
</html>
