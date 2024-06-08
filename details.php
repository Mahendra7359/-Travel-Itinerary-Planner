<?php

session_start();
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel  : Details</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
    <style>
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
                            
                        </div>
                    </span>
                </div>
                <div id="packages_box">
                    <?php
                    if (isset($_GET['pack_id'])) {
                        $package_id = $_GET['pack_id'];

                        $get_pack = "select * from packages where package_id='$package_id'";

                        $run_pack = mysqli_query($con, $get_pack);

                        while ($row_pack = mysqli_fetch_array($run_pack)) {
                            $pack_id = $row_pack['package_id'];
                            $pack_title = $row_pack['package_title'];
                            $pack_price = $row_pack['package_price'];
                            $pack_image = $row_pack['package_image'];
                            $pack_desc = $row_pack['package_desc'];
                            $pack_nights = $row_pack['package_nights'];
                            $pack_hotel = $row_pack['package_Hotel'];
                            $package_activity = $row_pack['package_activity'];
                            $flight_deatils = $row_pack['Flight_Details'];
                            echo "
                            <div id='details-package'>
                            <h3 style='font-family: Cambria; margin-bottom: 2px;'>$pack_title</h3>
                            <div class='main-desc'>
                            <img src='admin_area/package_images/$pack_image' width='400' height='300'>
                            <div class='details-desc'>
                            <p><b>Cost $ $pack_price</b></p>
                            <p><b>Hotel :- $pack_hotel For $pack_nights Nights</b></p></br>
                            <p>$pack_desc</p><br/>";

                            if(!empty($package_activity)){
                                $myArray = explode(',', $package_activity);
                                echo 'Activity:- <br/>';
                                foreach($myArray as $k){
                                    echo "$k"."</br>";
                                }
                            }
                            if(!empty($flight_deatils)){
                                $myArray = explode(',', $flight_deatils);
                                echo '</br>Flight:- <br/>';
                                foreach($myArray as $k){
                                    echo "$k"."</br>";
                                }
                            }

                            echo "</br><a href='index.php' style='float: left; font-size: 18px;'>Go Back</a>
                            <a href='index.php?add_cart=$pack_id'><button style='float: right;'>Add to Cart</button></a>
                            </div>
                            </div>
                            </div>
                            ";
                        }
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