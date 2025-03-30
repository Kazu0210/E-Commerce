<nav id="navbar">
    <button id="menubtn">
        <img src="assets/images/menu-burger-white.png" alt="menu button icon">
    </button>
    <!-- <div id="logo">&lt;Tech & Gadgets/&gt;</div> -->
    <div id="logo-cont">
        <img src="assets/images/tech-gadgets-logo.png" alt="" id="logo-img">
    </div>
    <div id="searchBar">
        <form action="" method="post">
            <input type="text" name="searchInput" id="searchInput" placeholder="Search here">
            <button type="submit" name="searchBtn" id="searchBtn">
                <img src="assets/images/search-white.png" alt="search-icon" id="searchIcon">
            </button>
        </form>
    </div>
    <div id="buttons">
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <?php if (isset($_SESSION['username'])): ?>
                <button name="cartBtn" id="cartBtn">
                    <img src="assets/images/cart-white.png" alt="cart-icon" id="cartIcon">
                </button>
    
                <button name="userBtn" id="userBtn">
                    <img src="assets/images/user-white.png" alt="user-icon" id="userIcon">
                </button>
                <button type="submit" name="logout" id="logoutBtn">Logout</button>
            <?php else: ?>
                <button type="submit" name="login" id="loginBtn">Login</button>
                <button type="submit" name="register" id="registerBtn">Register</button>
            <?php endif; ?>
        </form>
    </div>
</nav>
<div id="categories">
    <nav>
        <ul>
            <li id="homeLink"><a href="#">Home</a></li>
            <li><a href="#">Smartphones & Accessories</a></li>
            <li><a href="#">Laptops & Accessories</a></li>
            <li><a href="#">Audio & Wearables</a></li>
            <li><a href="#">Gaming Gear</a></li>
            <li><a href="#">Smart Home Devices</a></li>
        </ul>
    </nav>
</div>