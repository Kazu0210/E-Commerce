<?php
include 'db.php'; // import database connection file

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['register'])) {
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $phoneNum = $_POST['phoneNum'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $postalCode = $_POST['postalCode'];
        $country = $_POST['country'];
        $role = $_POST['userRole'];

        if (!empty($fullName) && !empty($email) && !empty($username) && !empty($password) && !empty($phoneNum) && !empty($address) && !empty($city) && !empty($postalCode) && !empty($country) && !empty($role)) {
            $conn->query("INSERT INTO user_tbl (full_name, email) VALUES ('$fullName', '$email')"); // insert data to database
        } else {
            echo "Please fill in all fields.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce | Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="" method="post">
        <input type="text" name="fullName" id="fullNameInput" placeholder="Full Name" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '')">
        <input type="email" name="email" id="email" placeholder='example@email.com'>
        <input type="text" name="username" id="username" placeholder="Username">
        <input type="password" name="password" id="password" placeholder="Password"> 
        <input type="number" name='phoneNum' id='phoneNum' placeholder='Phone Number'>
        <input type="text" name='address' id='address' placeholder='Address' maxlength='100'>
        <input type="text" name='city' id='city' placeholder='City' maxlength='50'>
        <input type="number" name='postalCode' id='postalCode' placeholder='Postal Code' maxlength='10'>
        <input type="text" name='country' id='country' placeholder='Country' maxlength='60' oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '')">
        <input type="hidden" name='userRole' id='userRole' placeholder='User Role'>

        <button type="submit" name="register">Register</button>
    </form>
    <a href="login.php">Already have an account? Login here.</a>

    <script>
        document.getElementById('fullNameInput').addEventListener("keypress", function (event) {
            let key
        });
    </script>
</body>
</html>

