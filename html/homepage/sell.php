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

    <div class="seller">
    <?php
    if($flag){
        $sql = "select ProductName, Price, Image,Description,quantity,ProductID  from Product where seller = '$_SESSION[Username]'";
        $result = mysqli_query($con,$sql);
    echo '<h1>&emsp;HI! '.$_SESSION['Username'].'!<br>&emsp;HERE\'S THE PRODUCTS YOU ARE SELLING</h1><br>';
    echo '<br>&ensp;&emsp;';
    echo '<p style="color:black">*click on the desired field in your product to edit*</p>
          <p style="color:black">Note: you can only edit one at a time</p>';
    echo '<table>';
    echo '<tr>
        <th>PRODUCT NAME</th>
        <th>IMAGE</th>
        <th>PRICE</th>
        <th>DESCRIPTION</th>
        <th>QUANTITY</th>';
    ;
    while($result_row = $result->fetch_assoc()){
        echo '<tr>
              <td id="ProductName">'. $result_row['ProductName'].'</td>'
            .'<td id="Image">'. $result_row['Image'].'</td>'
            .'<td id="Price">$'.$result_row['Price'].'</td>'
            .'<td id="Description">', $result_row['Description'].'</td>'
            .'<td id="quantity">', $result_row['quantity'].'</td>'
            .'<td id="ProductID">
            <form action="deletesell.php" method="post" >
            <button class="delete" name="deleteID" value="'.$result_row['ProductID'].'">delete</button>
            </form></td>'
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
                <input style="color:black" type="number" name="price" placeholder="Price">
                <input style="color:black" type="number" name="quantity" placeholder="Quantity">
                <input style="color:black" type="text" name="description" placeholder="Description">
                <label style="color:black" for="image">Image</label>
                <input type="file" accept='image/*' name="image" placeholder="Image">
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
    <!-- <script src="../../core/js/main.js"></script> -->
    <script>
        const addProductButton = document.getElementById("addProductButton");
        const modalsell = document.getElementById("modalsell");
        const seller = document.querySelector('.seller');

        addProductButton.addEventListener("click",() => {
            modalsell.style.display = "block";
        });

        flag = true;//this flag prevent multiple edits
        seller.addEventListener("click",() => {
          if(event.target.tagName === 'TD' && event.target.id!=='ProductID' && flag && event.target.id !== "Image"){
            var id = event.target.parentElement.lastChild.querySelector('form').querySelector('button').value;
            console.log(event.target.id);
            var temp = event.target.textContent;
            var style = "color:black";
            var style2 = "color:black;width:30%";
            event.target.textContent = "";
            var form = document.createElement('form');
            form.action = "update-sell.php";
            form.method = "post";
            event.target.appendChild(form);
            hiddenInput = document.createElement('input');
            hiddenInput.type = "hidden";
            hiddenInput.name = "columnname";
            hiddenInput.value = event.target.id;
            if(event.target.id==='quantity'||event.target.id==='Price')
            form.innerHTML = '<input type="number" name="input" style="'+style2+'" value="'+temp+'">';
            else
            form.innerHTML = '<input type="text" name="input" style="'+style+'" value="'+temp+'">';
            form.appendChild(hiddenInput);
            var cancel = document.createElement('button');
            cancel.innerHTML = "cancel";
            form.appendChild(cancel);
            cancel.type="button";
            var confirm = document.createElement('button');
            confirm.innerHTML = "confirm";
            confirm.type = "submit";
            form.appendChild(confirm);
            cancel.style.margin='0';
            cancel.style.color='black'
            cancel.style.cursor="pointer";
            confirm.style.cursor="pointer";
            confirm.style.margin='0';
            confirm.style.color='black';
            confirm.name = "id";
            confirm.value = id;
            flag = false;
            cancel.addEventListener("click",()=>{ location.reload();});
          }
          else if(event.target.id === "Image"){
            var id = event.target.parentElement.lastChild.querySelector('form').querySelector('button').value;
            var form = document.createElement('form');
            form.action = 'uploadimg.php';
            form.method = 'post';
            event.target.appendChild(form);
            var input = document.createElement('input');
            input.type = 'file';
            input.name = 'img';
            input.accept = 'image/*';
            form.appendChild(input);
            var button = document.createElement('button');
            button.innerHTML = 'submit';
            button.type = 'submit';
            button.name = "id";
            button.value = id;
            button.style.margin = '0';
            button.style.padding = '0';
            button.style.color = 'black';
            form.appendChild(button);
          }
        });

        function Close() {
          let modal = document.getElementById("modalsell");

          modal.style.display = "none";
        }

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
        
    </script>
    <!-- <script src="../../core/js/main.js"></script> -->
  </body>
  
</html>