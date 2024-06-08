<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>my orders</title>

</head>

<body>
    <!--Main container starts here-->
    <?php
    include("includes/db.php");
    $user = $_SESSION['customer_email'];

    $get_customer = "select * from Orders where c_email='$user'";
    
    $run_customer = mysqli_query($con, $get_customer);
    

    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <h2>Your Orders</h2>
        <table align="center" width="750">
            <tr align="center">
                <td>
                    Name
                </td>
                <td>
                    Passport
                </td>
                <td>
                    Package Name
                </td>
                <td>
                    Amount
                </td>
                <td>
                    Date
                </td>
            </tr>
            <?php 
            while ($row_customer = mysqli_fetch_array($run_customer)) {
                $c_name = $row_customer['c_name'];
                $c_passport = $row_customer['c_passport'];
                $Package_Name = $row_customer['Package_Name'];
                $order_price = $row_customer['order_price'];
                $Booking_date = $row_customer['Booking_date'];
                echo "<tr align='center'><td>".$c_name."</td>"."<td>".$c_passport."</td>"."<td>".$Package_Name."</td>"."<td>".$order_price."</td>"."<td>".$Booking_date."</td>"."</tr>";
            }
            
            ?>
        </table>
    </form>

</body>

</html>

<?php

global $con;

if (isset($_POST['update'])) {

    $ip = getIp();

    $customer_id = $c_id;

    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    //$c_passport = $_POST['c_passport'];
    //$c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];

    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];


    // ashrafkabir v0.1
    $update_c;
    if ($_FILES['c_image']['name'] == "") {
        $update_c = "update customers set customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass', customer_city='$c_city', customer_contact='$c_contact', customer_address='$c_address' where customer_id='$customer_id'";

    } else {
        move_uploaded_file($c_image_tmp, "customer_images/$c_image");
        $update_c = "update customers set customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass', customer_city='$c_city', customer_contact='$c_contact', customer_address='$c_address', customer_image='$c_image' where customer_id='$customer_id'";
    }

    $run_update = mysqli_query($con, $update_c);

    if ($run_update) {
        echo "<script>alert('Your account has successfully updated!')</script>";
        echo "<script>window.open('my_account.php','_self')</script>";
    }

    /*
    move_uploaded_file($c_image_tmp, "customer_images/$c_image");
    $update_c = "update customers set customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass', customer_city='$c_city', customer_contact='$c_contact', customer_address='$c_address', customer_image='$c_image' where customer_id='$customer_id'";

    $run_update = mysqli_query($con, $update_c);

    if ($run_update) {
        echo "<script>alert('Your account has successfully updated!')</script>";
        echo "<script>window.open('my_account.php','_self')</script>";
    }
    */

}
?>