<?php
  session_start();
  $con = mysqli_connect("localhost","root","","OnlineShop");
  $pid = $_POST['pid'];
  $username = $_SESSION['Username'];
  $uid =  mysqli_query($con, "select userid from user where username = '$username'")->fetch_assoc()['userid'];
  
  $flag = isset($_SESSION["Username"]);
  if($flag){
    $sql = "insert into cart values(NULL,'$uid','$pid')";
    $result = mysqli_query($con, $sql) or die($con->error);
    header("Location: index.php");
  }
?>