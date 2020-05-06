<?php
  session_start();
  $con = mysqli_connect("localhost","root","","OnlineShop");
  $flag = isset($_SESSION["Username"]);
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
              <a class="selection__item">User</a>
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
                      </li>';
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

    <!-- <h1>CART</h1> -->

    <div class="gallery">
    <ul class="gallery-items">
    <?php
    if($flag){
        $username = $_SESSION['Username'];
        $id =  mysqli_query($con, "select userid from user where username = '$username'")->fetch_assoc()['userid'];
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
                  <form action="removetocart.php" method = "post">
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
      if($flag){
        echo "<table>
        <th>Product</th>
        <th>Price</th>
        ";
        $sum = 0;
        while($result_row = $result->fetch_assoc()){
          $sum+=$result_row['Price'];
            echo '<tr>
            <td class="prodname">'.$result_row['ProductName'].'</td>
            <td>'."$".$result_row['Price'].'</td>
            </tr>';
        }
        echo "</table>";
        echo "<hr><h1 class='sum'><span class='total'>TOTAL</span>$".$sum."</h1>";
        echo "<button class='btn-buy'>checkout</button>";
      }
      ?>
      
    </div>
  </div>
  </div>

    <footer>
      Made by Rey Joshua H. Macarat and Jonathan Jubeth Ollave <br />
      © 2020 F1. All Rights Reserved.
    </footer>
  </body>
</html>