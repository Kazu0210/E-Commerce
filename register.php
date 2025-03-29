<?php
include 'db.php'; // import database connection file

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['register'])) {
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $phoneNum = $_POST['phoneNum'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $postalCode = $_POST['postalCode'];
        $country = $_POST['country'];
        $role = 'customer';

        if (!empty($fullName) && !empty($email) && !empty($username) && !empty($password) && !empty($phoneNum) && !empty($address) && !empty($city) && !empty($postalCode) && !empty($country)) {
            $conn->query("INSERT INTO user_tbl (full_name, email, username, password, phone_num, address, city, postal_code, country, user_role) VALUES ('$fullName', '$email', '$username', '$hash_password', '$phoneNum', '$address', '$city', '$postalCode', '$country', '$role')"); // insert data to database
            $notifMessage = "✅ Registration successful! Redirecting to Login...";
            $notifType = "success";

            echo "<script>
                    setTimeout(() => { window.location.href = 'login.php'; }, 2000);
                </script>";
        } 
        else {
            echo "Please fill in all fields.";
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
    <link rel="stylesheet" href="assets/css/register.css">
    <link rel="stylesheet" href="assets/css/notification.css">
    <title>E-Commerce | Register</title>
</head>
<body>
    <div class="notif-container" id="notif-container"></div>

    <div id="main-cont">    
        <div id="form-cont">
            <form action="" method="post">
                <div class="title-cont">
                    <p class="title">REGISTER</p>
                    <p class="description">Create an account.</p>
                </div>
                <div class="input-cont">
                    <p class="label">Full name</p>
                    <input type="text" name="fullName" id="fullNameInput" placeholder="Full Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '')">
                </div>
                
                <div class="group-cont">
                    <div class="input-cont">
                        <p class="label">Email</p>
                        <input type="email" name="email" id="email" placeholder='example@email.com'>
                    </div>
                    <div class="input-cont">
                        <p class="label">Username</p>
                        <input type="text" name="username" id="username" placeholder="Username" maxlength='30'>
                    </div>
                </div>
                <div class="input-cont">
                    <p class="label">Password</p>
                    <input type="password" name="password" id="password" placeholder="Password"> 
                </div>

                <div class="group-cont">
                    <div class="input-cont">
                        <p class="label">Phone number</p>
                        <input type="number" name='phoneNum' id='phoneNum' placeholder='Phone Number'>
                    </div>
                    <div class="input-cont">
                        <p class="label">Address</p>
                        <input type="text" name='address' id='address' placeholder='Address' maxlength='100'>
                    </div>
                </div>
                <div class="group-cont">
                    <div class="input-cont">
                        <p class="label">City</p>
                        <input type="text" name='city' id='city' placeholder='City' maxlength='50'>
                    </div>
                    <div class="input-cont">
                        <p class="label">Postal Code</p>
                        <input type="number" name='postalCode' id='postalCode' placeholder='Postal Code' maxlength='10'>
                    </div>
                </div>
                <div class="input-cont">
                    <p class="label">Country</p>
                    <input type="text" name='country' id='country' maxlength='60' oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '')">
                </div>  
                <input type="hidden" name='userRole' id='userRole' placeholder='User Role'>
        
                <button type="submit" name="register">REGISTER</button>
                <a href="login.php" id="loginLink">Already have an account? Login here.</a>
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
</body>
</html>

