<?php
session_start();
include "db.php";

// Clear session if user navigates back
if (!isset($_SESSION['back_pressed'])) {
    unset($_SESSION['email'], $_SESSION['otp'], $_SESSION['otp_generated'], $_SESSION['otp_confirmed']);
}
$_SESSION['back_pressed'] = true; // Ensure it gets set

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
    return true;
}

// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     if (isset($_POST['submitEmail'])) {
//         if (isset($_SESSION['email'])) {
//             echo "OTP has already been sent to your email.";
//         } else {
//             $_SESSION['email'] = $_POST['email'];

//             if (!isset($_SESSION['otp_generated'])) {
//                 $_SESSION['otp'] = strval(random_int(100000, 999999)); // Generate OTP
//                 $_SESSION['otp_generated'] = true;
//                 $_SESSION['otp_confirmed'] = false;

//                 echo "OTP: " . $_SESSION['otp'];
//             }
//         }
//     } elseif (isset($_POST['submitOTP'])) {
//         if ($_POST['otp'] == $_SESSION['otp']) {
//             $_SESSION['otp_confirmed'] = true;
//             echo "OTP confirmed";
//         } else {
//             echo "Invalid OTP. Please try again.";
//         }
//     } elseif (isset($_POST['submitPassword'])) {
//         $password = $_POST['newpassword'];
//         $confirm_password = $_POST['confirmPass'];

//         if ($password !== $confirm_password) {
//             echo "Passwords do not match.";
//         } else {
//             $validationResult = validatePassword($password);
//             if ($validationResult !== true) {
//                 echo $validationResult; // Show validation error message
//             } else {
//                 $hashed_password = password_hash($password, PASSWORD_DEFAULT);
//                 $email = $_SESSION['email'];

//                 $sql = "UPDATE user_tbl SET password = ? WHERE email = ?";
//                 $stmt = $conn->prepare($sql);
//                 $stmt->bind_param("ss", $hashed_password, $email);

//                 if ($stmt->execute()) {
//                     session_destroy(); // Clear session after successful update
//                     header('Location: login.php');
//                     exit();
//                 } else {
//                     echo "Error updating password: " . $conn->error;
//                 }
//                 $stmt->close();
//             }
//         }
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/forgot-password.css">
    <title>E-Commerce | Forgot Password</title>
</head>
<body>
    <div id="main-cont">
        <div id="form-cont">
            <?php if (!isset($_SESSION['email'])) { ?>
                <form action="" method="post">
                    <div class="title-cont">
                        <p class="title">Forgot Password</p>
                    </div>
                    <div class="input-cont">
                        <p class="label">Email</p>
                        <input type="email" name="email" placeholder="example@email.com" required>
                    </div>
                    <button type="submit" name="submitEmail">Confirm</button>
                </form>
            <?php } elseif (!isset($_SESSION['otp_confirmed']) || $_SESSION['otp_confirmed'] == false) { ?>
                <form action="" method="post">
                    <p class="title">Email Verification</p>
                    <input type="text" name="otp" placeholder="One-time Password" required>
                    <button type="submit" name="submitOTP">Confirm</button>
                </form>
            <?php } else { ?>
                <form action="" method="post">
                    <p class="title">Enter Password</p>
                    <input type="password" name="newpassword" placeholder="Password" minlength="8" maxlength="64" required>
                    <input type="password" name="confirmPass" placeholder="Confirm Password" minlength="8" maxlength="64" required>
                    <input type="checkbox" id="showpassword">
                    <label for="showpassword">Show Password</label>
                    <button type="submit" name="submitPassword">Confirm</button>
                </form>
            <?php } ?>
        </div>
    </div>

    <script>
    window.addEventListener("pageshow", function(event) {
        if (event.persisted) {
            fetch("clear_session.php", { method: "GET" }) 
            .then(response => console.log("Session cleared"));
        }
    });

    document.getElementById('showpassword').addEventListener('click', function() {
        let passwordInput = document.querySelector('[name="newpassword"]');
        let confirmPass = document.querySelector('[name="confirmPass"]');
        let type = this.checked ? "text" : "password";
        passwordInput.type = type;
        confirmPass.type = type;
    });
    </script>
</body>
</html>
