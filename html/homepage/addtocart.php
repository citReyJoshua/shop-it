<?php
  session_start();
  $flag = isset($_SESSION["Username"]);
  if($flag){
  $con = mysqli_connect("localhost","root","","OnlineShop");
  $pid = $_POST['pid'];
  $quantity = $_POST['quantity'];
  $username = $_SESSION['Username'];
  $uid =  mysqli_query($con, "select userid from user where username = '$username'")->fetch_assoc()['userid'];
  
  $sql = "insert into cart values(NULL,'$uid','$pid','$quantity')";
  $result = mysqli_query($con, $sql) or die($con->error);
  header("Location: index.php");
  }
  else header("Location: ../login-and-sign-up/log-in-and-sign-up.php");
?>