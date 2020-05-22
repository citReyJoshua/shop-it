<?php
  session_start();
  $con = mysqli_connect("localhost","root","","OnlineShop");
  $flag = isset($_SESSION["Username"]);
  $username = $_SESSION['Username'];
  $uid =  mysqli_query($con, "select userid from user where username = '$username'")->fetch_assoc()['userid'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css?family=Baloo+Chettan+2&display=swap"
      rel="stylesheet"
    />
    <link 
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="../../core/sass/main.css" />
    <title>
      <?php
        if($flag){
          $Username = $_SESSION["Username"];
          echo 'Welcome '. strtoupper($Username). "!";
        }
        else{
          echo 'Stylesworth';
        } 
      ?>
    </title>
  </head>
  <body> 
    <div class="nav">
      <ul>
        <li class="nav__item font-8 font-large">
          <a href="./index.php">
            Stylesworth
          </a>
          
        </li>
        
        <li class="nav__item">
        
          <div class="search" id="search" >
          
            <form action="search.php" method="post">
            <input class="search__item" type="text" placeholder="Search" name="search"/>
            <button type="submit"><i class="fa fa-search search__item"></i></button>
            </form>
          </div>
          
        </li>
        
        <li class="nav__item font-8" style="display: flex;">
          <ul
            class="user-selection slide-left"
            id="user-links"
            style="display: none; margin-right: -70px;"
          >
            <li class="selection__container">
                <a 
                href="myaccount.php"
                class="selection__item">My Account</a>
            </li>
            <li class="selection__container">
              <a
                href="../login-and-sign-up/log-in-and-sign-up.php"
                class="selection__item"
                >Login</a
              >
            </li>
            <li class="selection__container">
              <a
                href="../login-and-sign-up/log-in-and-sign-up.php"
                class="selection__item"
                >Sign up
              </a>
            </li>
            <?php
              if($flag){
                echo '<li class="selection__container">
                        <a class="selection__item" href="logout.php" name="logout">
                          Log out
                        </a>
                      </li>
                      <li class="selection__container">
                        <a class="selection__item" href="sell.php">
                          SELL
                        </a>
                      </li>
                      <li class="selection__container">
                        <a class="selection__item" href="cart.php">
                          <i class="fa fa-shopping-cart"></i>
                        </a>
                      </li>
                      ';
              }
            ?>

          </ul>

          <button class="btn-user" onclick="ToggleSlide()">
            
            <img class="img" src="../../core/images/user.png" alt="User" />
          </button>
          
        </li>
      </ul>
      
    </div>
    <div class="orders">
        <h1>ORDER DETAILS</h1>
        <?php
            $con = mysqli_connect("localhost","root","","OnlineShop");
            $sql = "select s.CompanyName,s.deliveryTime,o.orderid,o.date,p.image,p.productname,p.price from order_details o join product p join shipping s where o.userid=$uid and p.productid=o.productid and s.shippingid=o.shippingid order by date desc";
            $result = mysqli_query($con, $sql) or die($con->error);
            $delivered = "<p class='delivered'>Delivered</p>";
            $tobeDelivered = "<p class='tobeDelivered'>To be delivered</p>";
            $shipping = mysqli_query($con, "select * from shipping s join order_details o where s.ShippingID=o.ShippingID")->fetch_assoc();
            echo "<ul>";
            while($result_row = $result->fetch_assoc()){
                echo "<li>
                <div class='oship'>Delivery: ".$result_row['CompanyName']." (".$result_row['deliveryTime']." days)</div>
                <p>Order ID: ".$result_row['orderid']."</p>".
                "<p>Placed Order on ".$result_row['date']."</p>".
                "<img src='../../core/images/".$result_row['image']."'class='pimage'/>".
                "<div class='nameprice'><p>".$result_row['productname']."</p>".
                "<p>$".$result_row['price']."</p></div>";
                $Date = date("Y-m-d",strtotime("-".$shipping['deliveryTime']." days"));
                if($Date>=$result_row['date']){
                    echo $delivered;
                }
                else echo $tobeDelivered;
                
                echo "</li>";
            }
            echo "</ul>";

        ?>
    </div>
    <footer>
      Made by Rey Joshua H. Macarat and Jonathan Jubeth Ollave <br />
      © 2020 F1. All Rights Reserved.
    </footer>
    <script src="../../core/js/main.js"></script>
  </body> 
</html>