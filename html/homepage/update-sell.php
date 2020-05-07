<?php
    $columnName = $_POST['columnname'];
    $input = $_POST['input'];
    $pid = $_POST['id'];
    $con = mysqli_connect("localhost","root","","OnlineShop");
    $sql = "update product set $columnName = '$input' where productID = $pid";
    mysqli_query($con, $sql) or die("Product not added to database");
    header('Location: ../homepage/sell.php');
?>