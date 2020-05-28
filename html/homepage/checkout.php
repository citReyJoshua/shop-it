<?php
    session_start();
    $con = mysqli_connect("localhost","root","","OnlineShop");

    $username = $_SESSION['Username'];
    $uid =  mysqli_query($con, "select userid from user where username = '$username'")->fetch_assoc()['userid'];

    $sql = "select userid,productid,quantity from cart where userID = $uid ";
    $result = mysqli_query($con, $sql) or die($con->error);
    $shippingCo = $_SESSION['shippingCo'];
    $shippingID = mysqli_query($con, "select shippingID from shipping where CompanyName = '$shippingCo'")->fetch_assoc()['shippingID'];
    while($result_row = $result->fetch_assoc()){
        $uid = $result_row['userid'];
        $pid = $result_row['productid'];
        $cquantity = $result_row['quantity'];
        $date = date("Y-m-d");
        $quantity = mysqli_query($con,"select quantity from product where productid=$pid")->fetch_assoc()['quantity'];
        $quantity-=$cquantity;
        mysqli_query($con,"update product set quantity = $quantity where productid=$pid");
        mysqli_query($con, "insert into order_details values(NULL,$uid,$pid,'$date','$shippingID',$cquantity)") or die($con->error);
    }
    mysqli_query($con, "delete from cart where userid = $uid") or die($con->error);
    header("Location: orders.php");
       
?>