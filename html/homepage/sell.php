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
          <div class="search" id="search">
            
            <form action="search.php" method="post">
            <input class="search__item" type="text" placeholder="Search" />
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
    </div>

    <div class="seller">
    <?php
    if($flag){
        $sql = "select ProductName, Price, Image,Description,quantity  from Product where seller = '$_SESSION[Username]'";
        $result = mysqli_query($con,$sql);
    echo '<h1>&emsp;HI! '.$_SESSION['Username'].'!<br>&emsp;HERE\'S THE PRODUCTS YOU ARE SELLING</h1><br>';
    echo '<br>&ensp;&emsp;';
    echo '<table>';
    echo '<tr>
        <th>PRODUCT NAME</td>
        <th>IMAGE</td>
        <th>PRICE</td>
        <th>DESCRIPTION</td>
        <th>QUANTITY</td>';
    ;
    while($result_row = $result->fetch_assoc()){
        echo '<tr>
              <td>'. $result_row['ProductName'].'</td>'
            .'<td>'. $result_row['Image'].'</td>'
            .'<td>'.$result_row['Price'].'</td>'
            .'<td>', $result_row['Description'].'</td>'
            .'<td>', $result_row['quantity']
            .'</tr>';
    }
    
    echo "</table>";
    
    }
    ?>
    <div class="modalsell" id="modalsell">
        <div class="modalsell-content" id="modalsell-content">
          <span class="close" onclick="Close()" id="close">&times;</span>
          <h2>ENTER PRODUCT DETAILS</h2>
            <form action="addsell.php" method="post">
                <input style="color:black" type="text" name="prodname" placeholder="Product Name">
                <input style="color:black" type="text" name="image" placeholder="Image">
                <input style="color:black" type="number" name="price" placeholder="Price">
                <input style="color:black" type="number" name="quantity" placeholder="Quantity">
                <input style="color:black" type="text" name="description" placeholder="Description">
                <button type="submit" class="btn-buy">submit</button>
            </form>
        </div>
    </div>
    <button class="btn-buy" id="addProductButton"><i class="fa fa-plus-square"> add product </i></button>
    </div>
    <footer>
      Made by Rey Joshua H. Macarat and Jonathan Jubeth Ollave <br />
      © 2020 F1. All Rights Reserved.
    </footer>
    <script src="../../core/js/main.js"></script>
    <script>
        const addProductButton = document.getElementById("addProductButton");
        const modalsell = document.getElementById("modalsell");

        addProductButton.addEventListener("click",() => {
            modalsell.style.display = "block";
        });
        function Close() {
        let modal = document.getElementById("modalsell");

        modal.style.display = "none";
        }
    </script>
  </body>
  
</html>