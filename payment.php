<?php
if (isset($_POST['Book'])) {
    $con = mysqli_connect("localhost", "root", "", "tagency");
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_passport = $_POST['c_passport'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];
    $order_price = $_POST['order_price'];
    $Package_Name = $_POST['Package_Name'];
    $Booking_date = $_POST['Booking_date'];
     
    $insert_c = "INSERT INTO Orders (c_name, c_email, c_passport, c_city, c_contact, c_address, order_price,Package_Name,Booking_date) VALUES ('$c_name', '$c_email', '$c_passport', '$c_city', '$c_contact', '$c_address', $order_price,'$Package_Name','$Booking_date')";
    
    $run_c = mysqli_query($con, $insert_c);
    

    if ($run_c == 1) {
        $_SESSION['customer_email'] = $c_email;
        echo "<script>alert('Order has been created successfully. Thanks!')</script>";
        echo "<script>window.open('../customer/my_account.php','_self')</script>";
    } else {
        echo "<script>alert('Retry. Thanks!')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }

}
?>
 <form action="includes/payment.php" method="post" enctype="multipart/form-data">
                    <table align="center" width="750" style="margin-top: 20px;">
                        <tr align="center">
                            <td colspan="6">
                                <h2 style="margin-bottom: 15px; font-family: Cambria;">Enter Details to book package</h2>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Your Name:</td>
                            <td><input id="fixi" type="text" name="c_name" required=""></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Your Email:</td>
                            <td><input type="email" name="c_email" required="" value="<?php echo $_SESSION['customer_email']; ?>"> </td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Your Booking Date:</td>
                            <td><input type="date" name="Booking_date" required="" /> </td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Your Passport ID:</td>
                            <td><input type="text" name="c_passport" required=""></td>
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
                        <tr>
                            <td align="right" id="fixm">Package:</td>
                            <td><input id="fixi" type="text" read-only value="<?php echo $_SESSION['package'] ?>" name="Package_Name" required=""></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Amount</td>
                            <td><input id="fixi" type="number" read-only value="<?php echo $_GET['price'] ?>" name="order_price" required=""></td>
                        </tr>
                        <tr align="center">
                            <td colspan="6"><input id="btn" type="submit" name="Book" value="Create Account">
                            </td>
                        </tr>
                    </table>
                </form>
