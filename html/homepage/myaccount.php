<?php
  session_start();
  $con = mysqli_connect("localhost","root","","OnlineShop");
  $flag = isset($_SESSION["Username"]);
  $username = $_SESSION['Username'];
  $id =  mysqli_query($con, "select userid from user where username = '$username'")->fetch_assoc()['userid'];
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
    <div class="myAccount">
        <a href="orders.php">My orders</a>
        <h1>ACCOUNT DETAILS</h1>
        <p style="color:white">*click on the desired field in your user info to edit*</p>
        <p style="color:white">Note: you can only edit one at a time</p>
    <?php
        $Username = $_SESSION['Username'];
        $sql = "select * from user where Username = '$Username'";
        $result = mysqli_query($con,$sql);
        echo "<table>";
        while($result_row = $result->fetch_assoc()){
            echo "<tr>
                <td>Username</td>
                <td id='tdval'>".$result_row['Username']."</td>
            </tr>
            <tr>
                <td>Email</td>
                <td id='tdval'>".$result_row['Email']."</td>
            </tr>
            <tr>
                <td>Address</td>
                <td id='tdval'>".$result_row['Address']."</td>
            </tr>
            <tr>
                <td>Contact</td>
                <td id='tdval'>".$result_row['Contact']."</td>
            </tr>";
        }
        echo "</table>";
    ?>
    </div>
    <footer>
      Made by Rey Joshua H. Macarat and Jonathan Jubeth Ollave <br />
      © 2020 F1. All Rights Reserved.
    </footer>
    <script>
      var flag = true;
      document.querySelector('table').addEventListener('click',(e)=>{ 
        if(e.target.id === 'tdval' && flag){
          console.log(e.target.parentElement.children[0].textContent);
          var temp = e.target.textContent;
          e.target.textContent = "";
          var form = document.createElement("form");
          form.action = "edituser.php";
          form.method = "post";
          e.target.appendChild(form);
          var input = document.createElement("input");
          input.type = "text";
          input.value = temp;
          input.name = 'input';
          // input.name = e.target.parentElement.firstChild;
          // console.log(e.target.parentElement.firstChild);
          input.style.color = "black";
          input.style.width = "350px";
          // input.style.width = "fit-content";

          input.style.padding = "2px 10px";
          form.appendChild(input);

          var confirm = document.createElement("button");
          var cancel = document.createElement("button");
          confirm.innerHTML="confirm";
          confirm.style.color="black";
          confirm.type = 'submit';
          confirm.name = 'columnname';
          confirm.value = e.target.parentElement.children[0].textContent;

          cancel.innerHTML="cancel";
          cancel.style.color="black";
          cancel.type = 'button';
          cancel.addEventListener("click",()=>{ location.reload();});
          form.appendChild(confirm);
          form.appendChild(cancel);

          flag = false;
        }
      })
    </script>
    <script src="../../core/js/main.js"></script>
  </body> 
</html>