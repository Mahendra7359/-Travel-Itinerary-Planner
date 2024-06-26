<?php
session_start();
include("functions/functions.php");
include("includes/db.php");
global $con;
if (isset($_POST['register'])) {
    $ip = getIp();
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_passport = $_POST['c_passport'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];

    // image will upload there
    move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");

    $insert_c = "INSERT INTO customers (customer_ip,customer_name,customer_email,customer_pass,c_passport,customer_country,customer_city,customer_contact,customer_address,customer_image) VALUES ('$ip','$c_name','$c_email','$c_pass','$c_passport','$c_country','$c_city','$c_contact','$c_address','$c_image')";

    $run_c = mysqli_query($con, $insert_c);

    $sel_cart = "SELECT * FROM cart WHERE ip_add='$ip'";

    $run_cart = mysqli_query($con, $sel_cart);

    $check_cart = mysqli_num_rows($run_cart);

    if ($check_cart == 0) {
        $_SESSION['customer_email'] = $c_email;
        echo "<script>alert('Account has been created successfully. Thanks!')</script>";
        echo "<script>window.open('customer/my_account.php','_self')</script>";
    } else {
        $_SESSION['customer_email'] = $c_email;
        echo "<script>alert('Account has been created successfully. Thanks!')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Travel  : Register</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
    <style type="text/css">
        #fixm {
            font-size: 15px;
            padding: 4px;
            font-family: arial;
        }

        #fixi {
            font-size: 14px;
            font-family: arial;
        }

        #btn {
            font-family: arial;
            font-size: 14px;
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            background-color: #32E875;
            color: black;
        }

        #btn:hover {
            background-color: #4CAF50;
            color: white;
        }
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
                <form action="customer_register.php" method="post" enctype="multipart/form-data">
                    <table align="center" width="750" style="margin-top: 20px;">
                        <tr align="center">
                            <td colspan="6">
                                <h2 style="margin-bottom: 15px; font-family: Cambria;">Create an Account</h2>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Your Name:</td>
                            <td><input id="fixi" type="text" name="c_name" required=""></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Your Email:</td>
                            <td><input type="email" name="c_email" required=""></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Your Password:</td>
                            <td><input id="fixi" type="password" name="c_pass" required=""></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Your Passport ID:</td>
                            <td><input type="text" name="c_passport" required=""></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Your Image:</td>
                            <td><input id="fixi" type="file" name="c_image" required=""></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Your Country:</td>
                            <td>
                                <select name="c_country" required="">Select a
                                    <option>Bangladesh</option>
                                    <option>India</option>
                                    <option>Japan</option>
                                    <option>China</option>
                                    <option>Russia</option>
                                    <option>Portugal</option>
                                    <option>England</option>
                                    <option>Brazil</option>
                                    <option>Spain</option>
                                    <option>France</option>
                                    <option>Switzerland</option>
                                    <option>Croatia</option>
                                    <option>Argentina</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Your City:</td>
                            <td><input id="fixi" type="text" name="c_city" required=""></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Your Contact:</td>
                            <td><input id="fixi" type="text" name="c_contact" required=""></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Your Address:</td>
                            <td><input id="fixi" type="text" name="c_address" required=""></td>
                        </tr>
                        <tr align="center">
                            <td colspan="6"><input id="btn" type="submit" name="register" value="Create Account">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <!--Content ends here-->
        <!--footer starts-->
        <?php include "includes/footer.php"; ?>
        <!--footer ends-->
    </div>
    <!--Main container ends here-->
</body>
</html>
