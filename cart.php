<?php
session_start();
$total = 0;
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel : Cart</title>
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
                <div id="packages_box" style="padding:10px">
                    <form action="" method="post" enctype="multipart/form-data">
                        <table align="center" style="margin:auto" width="700px" bgcolor="skyblue">
                            <tr align="center">
                                <th>Remove</th>
                                <th>Package(s)</th>
                              
                                <th>Total Cost</th>
                            </tr>
                            <?php
                            global $con;
                            $ip = getIp();
                            $sel_price = "SELECT * FROM cart WHERE ip_add='$ip'";
                            $run_price = mysqli_query($con, $sel_price);

                            while ($p_price = mysqli_fetch_array($run_price)) {
                                $pack_id = $p_price['p_id'];
                                $pack_price = "SELECT * FROM packages WHERE package_id='$pack_id'";
                                $run_pack_price = mysqli_query($con, $pack_price);

                                while ($pp_price = mysqli_fetch_array($run_pack_price)) {
                                    $package_price = array($pp_price['package_price']);
                                    $package_title = $pp_price['package_title'];
                                    $package_image = $pp_price['package_image'];
                                    $single_price = $pp_price['package_price'];
                                    $values = array_sum($package_price);
                                    $total += $values;
                                    ?>
                                    <tr align="center">
                                        <td><input type="checkbox" name="remove[]" value="<?php echo $pack_id; ?>"></td>
                                        <td>
                                            <?php $_SESSION['package'] = $package_title; echo $package_title; ?><br>
                                            <img src="admin_area/package_images/<?php echo $package_image; ?>"
                                                 width="60px" height="60px">
                                        </td>
                                        
                                        <?php
                                        global $con;
                                        if (isset($_POST['update_cart'])) {
                                            $qty = $_POST['qty'];
                                            $update_qty = "UPDATE cart SET qty='$qty'";
                                            $run_qty = mysqli_query($con, $update_qty);
                                            $_SESSION['qty'] = $qty;
                                            $total = ($qty * $total);
                                        }
                                        ?>
                                        <td>
                                            <?php echo "$" . $single_price; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <tr align="right">
                                <td colspan="4"><b>Sub Total:</b></td>
                                <td>
                                    <?php echo "$" . $total; ?>
                                </td>
                            </tr>
                            <tr align="center">
                                <td colspan="2"><input type="submit" name="update_cart" value="Update Cart"></td>
                                <td><input type="submit" name="continue" value="Continue Shopping"></td>
                                <td>
                                    <button><a href="checkout.php?price=<?php echo $single_price; ?>"
                                               style="text-decoration: none; color: black;">Checkout</a></button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
                    function updatecart()
                    {
                        global $con;
                        $ip = getIp();

                        if (isset($_POST['update_cart'])) {
                            foreach ($_POST['remove'] as $remove_id) {
                                $delete_package = "DELETE FROM cart WHERE p_id='$remove_id' AND ip_add='$ip'";
                                $run_delete = mysqli_query($con, $delete_package);
                                if ($run_delete) {
                                    echo "<script>window.open('cart.php','self')</script>";
                                }
                            }
                        }
                        if (isset($_POST['continue'])) {
                            echo "<script>window.open('index.php','self')</script>";
                        }
                    }

                    echo @$up_cart = updatecart();
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