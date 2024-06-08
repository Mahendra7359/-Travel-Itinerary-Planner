<?php
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel  : Results</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
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
                <div id="shopping_cart">
                    <span style="float: right;font-size: 18px;padding: 5px;line-height: 40px;">Welcome Guest! <b
                                style="color: yellow;">Shopping Cart-</b> Total Items: Total Price: <a href="cart.php"
                                                                                                       style="color: yellow;">Go to Cart</a></b></span>
                </div>
                <div id="packages_box">
                    <?php
                    if (isset($_GET['search'])) {

                        $search_query = $_GET['user_query'];

                        $get_pack = "SELECT * FROM packages WHERE package_keywords LIKE '%$search_query%'";

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