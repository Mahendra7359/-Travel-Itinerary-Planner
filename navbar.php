<div class="menubar">
    <ul id="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="all_packages.php">All Packages</a></li>
        
        <?php
        if (isset($_SESSION['customer_email'])) {
            echo "<li><a href='customer/my_account.php'>My Account</a></li>";
        } else {
            echo "<li><a href='customer_register.php'>Sign Up</a></li>";
        }
        ?>
        
        <li><a href="cart.php">Shopping Cart</a></li>
    </ul>
    <div id="form">
        <form method="get" action="results.php" enctype="multipart/form-data">
            <input type="text" style="padding:9px" name="user_query" placeholder="Search all">
            <input id="search" style="padding: 11px;background: white;border: none;border-radius: 7px;" type="submit" name="search" value="Search">
        </form>
    </div>
</div>
