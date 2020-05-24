<?php
    session_start();
    $con = mysqli_connect("localhost","root","","OnlineShop");
    $username = $_SESSION['Username'];
    $id =  mysqli_query($con, "select userid from user where username = '$username'")->fetch_assoc()['userid'];
   
    $columnName = $_POST['columnname'];
    $input = $_POST['input'];

    $sql = "update user set $columnName = '$input' where userid = $id";
    mysqli_query($con, $sql) or die("Product not added to database");
    if($columnName=='Username'){
        $_SESSION['Username'] = $input;
        mysqli_query($con, "update product set seller = '$input' where seller = '$username'");
    }
    header('Location: ../homepage/myaccount.php');
?>