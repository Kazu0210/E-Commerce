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
        <input type="text" name="fullName" id="fullNameInput" placeholder="Full Name">
        <input type="email" name="email" id="email" placeholder='example@email.com'>
        <input type="text" name="username" id="username" placeholder="Username">
        <input type="password" name="password" id="password" placeholder="Password"> 
        <input type="text" name='phoneNum' id='phoneNum' placeholder='Phone Number'>
        <input type="text" name='address' id='address' placeholder='Address'>
        <input type="text" name='city' id='city' placeholder='City'>
        <input type="text" name='postalCode' id='postalCode' placeholder='Postal Code'>
        <input type="text" name='country' id='country' placeholder='Country'>
        <input type="hidden" name='userRole' id='userRole' placeholder='User Role'>

        <button type="submit" name="register">Register</button>
    </form>
</body>
</html>