<?php
    session_start();
    $prodname = $_POST['prodname'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $username = $_SESSION['Username'];
    $con = mysqli_connect("localhost","root","","OnlineShop");
    $sql = "insert into product values(NULL,'$prodname','$price','$image','$description','$quantity','$username')";
    mysqli_query($con, $sql) or die("Product not added to database");
    header('Location: ../homepage/sell.php');
?>