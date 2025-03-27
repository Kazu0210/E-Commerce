<?php
session_start(); // Start session

// Clear session if user navigates back
if (isset($_SESSION['back_pressed'])) {
    unset($_SESSION['email']);
    unset($_SESSION['otp']);
    unset($_SESSION['otp_generated']);
    unset($_SESSION['back_pressed']);
}

// Check if the user navigates back in the browser
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_SESSION['back_pressed'] = true;
}
function validatePassword($password) {
    if (strlen($password) < 8 || strlen($password) > 64) {
        return "Password must be between 8 and 64 characters.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must include at least one uppercase letter.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        return "Password must include at least one lowercase letter.";
    }
    if (!preg_match('/\d/', $password)) {
        return "Password must include at least one number.";
    }
    if (!preg_match('/[\W_]/', $password)) {
        return "Password must include at least one special character.";
    }
    return "Valid";
}

// // Example Usage
// $password = "SecureP@ss1";
// echo validatePassword($password); // Output: "Valid"

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submitEmail'])) {
        if (isset($_SESSION['email'])) {
            return; // Prevent re-generation
        } else {
            $_SESSION['email'] = $_POST['email'];
            
            // Prevent OTP regeneration on refresh
            if (!isset($_SESSION['otp_generated'])) {
                // Generate OTP
                $otp = '';
                for ($i = 0; $i < 6; $i++) {
                    $randomNum = random_int(0, 9);
                    $otp .= $randomNum;
                }
                $_SESSION['otp'] = $otp;
                $_SESSION['otp_generated'] = true; // Mark OTP as generated
                $_SESSION['otp_confirmed'] = false;
    
                echo "OTP: " . $otp;
            }
        }
    }
    elseif (isset($_POST['submitOTP'])) {
        $submmited_otp = $_POST['otp'];
        if ($submmited_otp == $_SESSION['otp']) {
            echo "OTP confirmed";
            $_SESSION['otp_confirm'] = true;
        }
    }
    elseif (isset($_POST['submitPassword'])) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirmPass'];

        if ($password == $confirm_password) {
            // Passwords match, proceed with registration

            // ❌ ADD PASSWORD VALIDATIONS
            // minimum lenght
            // max lenght
            // one uppercase latter
            // one lowercase letter
            // one number
            // one special character
            // no username or email in password
            // no repeating sequential characters
            // encrypt before storing

        }
        else {
            echo "Passwords do not match";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce | Forgot Password</title>
</head>
<body>
    <?php
        if (!isset($_SESSION['email'])) {
            ?>
            <form action="" method="post">
                <h1>Forgot Password</h1>
                <input type="email" name="email" id="email" placeholder="Enter Email" required>
                <button type="submit" name="submitEmail">Confirm</button>
            </form>
            <?php
        } elseif (isset($_SESSION['otp']) && isset($_SESSION['otp_confirmed']) && $_SESSION['otp_confirmed'] == false) {
            ?>
            <form action="" method="post">
                <h1>Email Verification</h1>
                <input type="text" name="otp" id="otp" placeholder="One-time Password" required>
                <button type="submit" name="submitOTP">Confirm</button>
            </form>
            <?php
        } elseif (!isset($_SESSION['newpassword'])) {
            ?>
            <form action="" method="post">
                <h1>Enter Password</h1>
                <input type="password" name="newpassword" id="newpassword" placeholder="Password" minlength="8" maxlength="64">
                <input type="password" name="confirmPass" id="confirmPass" placeholder="Confirm Password" minlength="8" maxlength="64">
                <button type="submit" name="submitPassword">Confirm</button>
            </form>
            <?php
        }
    ?>
    <script>
    window.addEventListener("pageshow", function(event) {
        if (event.persisted) { // This detects if the page was loaded from the bfcache (back-forward cache)
            fetch("clear_session.php", { method: "GET" }) // Send a request to clear session
            .then(response => console.log("Session cleared"));
        }
    });
    </script>
</body>
</html>