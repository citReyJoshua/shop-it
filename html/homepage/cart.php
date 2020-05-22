<?php
  session_start();
  $con = mysqli_connect("localhost","root","","OnlineShop");
  $flag = isset($_SESSION["Username"]);
  $username = $_SESSION['Username'];
  $id =  mysqli_query($con, "select userid from user where username = '$username'")->fetch_assoc()['userid'];
  $count = mysqli_query($con, "select count(*) as count from cart")->fetch_assoc()['count'];
  if(!$count){
    echo "<script>
    alert('your cart is empty, go shopping?');
    window.location.href = 'products.php'
    </script>";
  }
?>
<script></script>
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
    <div class="cart-page">
    <div class="cart-list">

    <div class="hcart">
      <h1>YOUR CART</h1>
    </div>

    <div class="gallery">
    <ul class="gallery-items">
    <?php
    if($flag && $count){
        $sql = "select cartID,ProductName, Price, Image,Description from Product p join cart c where c.userid = '$id' and p.ProductID = c.ProductID";
        $result = mysqli_query($con, $sql) or die($con->error);
        
        while($result_row = $result->fetch_assoc()){
            echo '<li class="gallery__item">
                <div class="card">
                <div class="card__image">
                <img
                src="../../core/images/' . $result_row['Image'] . 
                '"alt="product-image"
                class="product-image"
                />' . '</div>
                <div class="card__description">' . $result_row['Description'] .
                '</div>
                <div class="card__product-name">
                  '. $result_row['ProductName'] . '<br />
                  <span class="clr-black"> $' . $result_row['Price'] .
                '</span>
                </div>
                <div class="card__button">
                  <form action="removefromcart.php" method = "post">
                  <button type="submit" class="btn-buy" onclick="ToggleModal()" name="cid" value = "'.$result_row['cartID'].'">
                    remove
                  </button>
                  </form>
                </div>
              </div>
            </li>';
        }
    }
  ?>
  </ul>
  </div>
  </div>
  
  <div class="checkout">
    <div class="checkout-content">
      <h2>CHECKOUT DETAILS</h2>

      <?php
      $result = mysqli_query($con, $sql) or die($con->error);
      if($flag && $count ){
        echo "<table>
        <th>Product</th>
        <th>Price</th>
        ";
        $sum = 0;
        $items = 0;
        while($result_row = $result->fetch_assoc()){
          $items++;
          $sum+=$result_row['Price'];
            echo '<tr>
            <td class="prodname">'.$result_row['ProductName'].'</td>
            <td>'."$".$result_row['Price'].'</td>
            </tr>';
        }
        echo "</table>";
        echo "<hr><h1 class='sum'><span class='total'>TOTAL</span>$".$sum."</h1>";
        

        $sql = "select * from Shipping";
        $result = mysqli_query($con, $sql) or die($con->error);

        
        echo "<div class='shipping'>
        <label>PLEASE SELECT A SHIPPING COMPANY TO SHIP YOUR PRODUCT</label>
        <form action='' method='post'>
        <select name='shippingCo' onchange='this.form.submit()'>";
        "</form></div>";
        while($result_row = $result->fetch_assoc()){
          echo "<option 
          id ='".$result_row['CompanyName']."'
          value='".$result_row['CompanyName']."'>".$result_row['CompanyName']." rate: $".$result_row['rate']." (".$result_row['deliveryTime']." days)</option>";
        }
        echo "</select>";
        echo "</form></div>";
        if(isset($_POST['shippingCo'])){
          $shippingCo = $_POST['shippingCo'];
          echo "<script>
          document.getElementById('".$shippingCo."').selected = true;
          </script>";
        }
        else{
          $_POST['shippingCo'] = 'UPS';
          $shippingCo = $_POST['shippingCo'];
        }
        $_SESSION['shippingCo'] = $shippingCo;
        $sql = "select rate from shipping where CompanyName ='$shippingCo' ";
        $result = mysqli_query($con, $sql)->fetch_assoc()['rate'];
        $totalAmount = $sum + $result;
        echo "<div class='totalAmount'>
          <table>
            <tr>
              <td class='th'>Subtotal (".$items." items):</td>
              <td>$".$sum."</td>
            </tr>
            <tr>
              <td class='th'>Shipping Fee:</td>
              <td>$".$result."</td>
            </tr>
            <tr class='totalamounttr'>
              <td class='th'>Total Amount:</td>
              <td>$".$totalAmount."</td>
            </tr>
          </table>
        </div>";
        echo "<button class='btn-buy' id='checkoutbtn'>checkout</button>";
      }
      ?>
      
      
    </div>
  </div>
  </div>
      <div class="modal-checkout" id="modalCheckout">
        <div class="modal-checkout-content">
        <span class="close" onclick="Close()" id="close">&times;</span>
          <h2>CONTACT ADDRESS</h2>
          <?php
            if($flag){
              $sql = "select Email,Address,Contact from user where username = '$username'";
              $result = mysqli_query($con, $sql)->fetch_assoc() or die($con->error);
              echo "<div class='address'>"
              ."<p>your item will be delivered to this address:</p>"
              ."<h3>".$result['Address']."</h3></div>"
              ."<div class='contact'>"
              ."<p>we will be contacting you through this contact details</p>"
              ."<h3>Contact number :".$result['Contact']."</h3>"
              ."<h3>Email : ".$result['Email']."</h3>"
              ."</div>";
            }
          ?>
          <button class="btn-buy" id="confirm-checkout">confirm</button>
        </div>
      </div>
    <footer>
      Made by Rey Joshua H. Macarat and Jonathan Jubeth Ollave <br />
      © 2020 F1. All Rights Reserved.
    </footer>
    <script>
    function ToggleSlide() {
      let element = document.getElementById("user-links");
      let search = document.getElementById("search");
      if (element.style.display === "none") {
        search.style.marginRight = "-70px";
        element.style.display = "flex";
      } else {
        search.style.marginRight = "0";
        element.style.display = "none";
      }
      
    }
    document.getElementById("checkoutbtn").addEventListener("click",()=>{
      document.getElementById("modalCheckout").style.display="block";
    })
    function Close(){
      document.getElementById("modalCheckout").style.display="none";
    }
    document.querySelector("#confirm-checkout").addEventListener("click",()=>{
      window.location.href = ("http://localhost/git-shopit/Source%20Code/stylesworth-%20Online%20Fashion%20Shop/html/homepage/checkout.php")
    })
    </script>
  </body>
</html>