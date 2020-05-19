<?php
  session_start();
  $con = mysqli_connect("localhost","root","","OnlineShop");
  $img = $_POST['img'];
  $pid = $_POST['id'];
  $sql = "update product set Image = '$img' where productID = $pid ";
  mysqli_query($con, $sql) or die("Product not added to database");
  header('Location: ../homepage/sell.php');
?>