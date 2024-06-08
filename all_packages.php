<?php

session_start();
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
    <style>
        .adminbtn {
            background-color: #2c6596;
            border: 1px solid white;
            color: white;
            padding: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 17px;
            cursor: pointer;
            -webkit-transition-duration: 0.4s;
            transition-duration: 0.4s;
            float: right;
            /* margin-top: 12px; */
            /* margin-left: 2px; */
            border-radius: 6px;
        }
        .nav-button{
            background-color: #2c6596;
            border: 1px solid white;
            color: white;
            padding: 5px;
            text-align: center;
            
            display: inline-block;
            font-size: 17px;
            cursor: pointer;
            -webkit-transition-duration: 0.4s;
            transition-duration: 0.4s;
            border-radius: 6px;
        }
        .nav-button a{
            display:flex;
            align-items:center;
            color:white;
            text-decoration: none;
        }
        .nav-button a:hover{
            text-decoration: underline;
        }
        .adminbtn a {
            text-decoration: none;
        }
        .adminbtn a:hover {
            text-decoration: underline;
        }
      
    </style>
</head>
<body>
    <!--Main container starts here-->
    <div class="main_wrapper">
        <!--Header starts here-->
        <?php include 'includes/header.php'; ?>
        <!--Header ends here-->
      
        <!--Content starts here-->
        <div class="content_wrapper">
            <!--left-sidebar starts-->
            <?php include "includes/left-sidebar.php"; ?>
            <!--left-sidebar ends-->
            <div id="content_area">
            <?php cart(); ?>
                <div id="shopping_cart">
                    <span style="font-size: 18px;padding: 5px;display: flex;justify-content: space-between;align-items: center;">
                        <?php
                        if (isset($_SESSION['customer_email'])) {
                            echo "<b>Welcome:" . $_SESSION['customer_email'] . " </b>";
                        } else {
                            echo "<b>Welcome</b>";
                        }
                        ?>
                        <div style="display:flex;">
                            <button class='nav-button'>
                                <a href="cart.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="white" d="M17 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2M1 2v2h2l3.6 7.59l-1.36 2.45c-.15.28-.24.61-.24.96a2 2 0 0 0 2 2h12v-2H7.42a.25.25 0 0 1-.25-.25q0-.075.03-.12L8.1 13h7.45c.75 0 1.41-.42 1.75-1.03l3.58-6.47c.07-.16.12-.33.12-.5a1 1 0 0 0-1-1H5.21l-.94-2M7 18c-1.11 0-2 .89-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2"/></svg>
                                <?php total_items(); ?> Cart
                                </a>
                            </button>&nbsp;
                            <?php
                            if (!isset($_SESSION['customer_email'])) {
                                echo "<button class='nav-button'><a href='checkout.php' >
                                        User Login
                                    </a></button>&nbsp;";
                            } else {
                                echo " <button class='nav-button'><a href='logout.php' >Logout</a></button>&nbsp;";
                            }
                            ?>
                        </div>
                    </span>
                </div>
                <div id="packages_box">
                    <?php
                    $get_pack = "SELECT * FROM packages";

                    $run_pack = mysqli_query($con, $get_pack);

                    while ($row_pack = mysqli_fetch_array($run_pack)) {
                        $pack_id = $row_pack['package_id'];
                        $pack_cat = $row_pack['package_cat'];
                        $pack_type = $row_pack['package_type'];
                        $pack_title = $row_pack['package_title'];
                        $pack_price = $row_pack['package_price'];
                        $pack_image = $row_pack['package_image'];
                        $pack_nights = $row_pack['package_nights'];

                        echo "
                            <a href='details.php?pack_id=$pack_id' style='float: left;'>
                            <div id='single_package' style='background-image:url(admin_area/package_images/$pack_image)'>
                            <div class='package_info'>
                            <h5 class='title'>
                            Nights/$pack_nights
                            </h5>
                            <div>
                            $pack_title
                            <b> Price: $ $pack_price</b>
                            </div>
                            </div>
                            </div></a>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--Content ends here-->
        <!--footer starts-->
        <?php include "includes/footer.php";?>
        <!--footer ends-->
    </div>
    <!--Main container ends here-->
</body>
</html>