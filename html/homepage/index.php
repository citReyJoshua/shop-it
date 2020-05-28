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
              <a
                href="index.php"
                class="selection__item"
                >Home </a>
            </li>
          <?php
            if(!$flag){
              echo '<li class="selection__container">
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
                    </li>';
            }
          ?>
            
            <?php
              if($flag){
                echo '<li class="selection__container">
                        <a 
                          href="myaccount.php"
                          class="selection__item">My Account</a>
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
                      <li class="selection__container">
                        <a class="selection__item" href="logout.php" name="logout">
                          Log out
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
    <div class="hero">
      <div class="hero__item hero__text">
        Find clothes
        <span class="font-bolder font-large">
          worthy
        </span>
        <br />
        of your
        <span class="font-bolder font-large">
          style.
        </span>
      </div>
      <div>
        <img
          src="../../core/images/shopping.svg"
          alt="Shopping"
          style="width: 30em"
        />
      </div>
    </div>
    <div class="titles">
      <a href="products.php">Products</a>
    </div>
    <div class="gallery" id = "gallery">
      <ul class="gallery-items">
        <?php
          $sql = "select ProductID,ProductName, Price, Image,Description,quantity from Product";
          $result = mysqli_query($con, $sql);
          while($result_row = $result->fetch_assoc()){
            echo '<li class="gallery__item">
            <div class="card" onclick="ToggleModal(event)">
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
            <form action="addtocart.php" method="post">
            <input type="number" class="quantity" value="1" name="quantity" min="1" max = "'.$result_row['quantity'].'"/>
            <div class="card__button">
              <button type="submit" class="btn-buy" name="pid" value = "'.$result_row['ProductID'].'">
                Add to cart
              </button>
            </form>
            </div>
          </div>
        </li>';
          }
          
        ?>
        
      </ul>
    </div>
    <div class="modal" id="modal">
      <span class="close" onclick="Close()" id="close">&times;</span>
      <div class="modal__top">
        <img
          src="../../core/images/dress.png"
          alt="product-image"
          class="product-image--bigger"
          id = "modalimg"
        />
      </div>

      <div class="card__product-name--bigger" id = "modalpname">
        <br />
        <span id = "modalprice"> 
          
        </span>
      </div>
      <div class="card__description--bigger" id = "modaldesc">
        
      </div>
      <button class="btn-modal" id="btn-modal" onclick="Snack()">
        ADD TO CART
      </button>
    </div>
    <div id="snackbar">
      <div id="snackbar__content">
        ADDED TO CART
      </div>
    </div>
    
    <footer>
      Made by Rey Joshua H. Macarat and Jonathan Jubeth Ollave <br />
      © 2020 F1. All Rights Reserved.
    </footer>
    <script>
        // var btn = document.querySelectorAll('button.btn-buy');
        // function insertphp(pid){
    
        //     var php = "<\?php $_POST['pid'] = "+pid+"; header('Location: addtocart.php');\?>";
        //     // var php = "<\?php echo asd;?>";

        //     return php;
        // }
        // for (i=0;i<btn.length;i++){
        //     btn[i].addEventListener('click',(e)=>{
        //     var pid = e.target.value;
        //     // var div = document.createElement('php');
        //     // div.innerHTML = insertphp(pid);
        //     // console.log(e.target.parentElement);
        //     // e.target.parentElement.append(insertphp(pid));
        //     // alert(insertphp(pid));
        //     // document.HTML=insertphp(pid);
        //     // console.log(e.target.parentElement);
        //     alert("<\?php echo $_SESSION['USERNAME'];?>");
        // });
        // }
        // function mySubmit(){
        // }
    </script>
    <script src="../../core/js/main.js"></script>
  </body> 
</html>