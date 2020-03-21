<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Get Started!</title>
    <link rel="stylesheet" href="../../core/sass/account.css" />
  </head>
  <body>
    <div class="container" id="container">
      <div class="form-container sign-up-container">
        <form action="" name="SignUp" method="post" onsubmit="return validateFormReg()" required>
          <h3>Create StylesWorth Account</h3>
          <span>or use your email for registration</span>
          <br />
          <input type="text" placeholder="Username" name="SignUpUsername"/>
          <input type="email" placeholder="Email" name="Email"/>
          <input type="password" placeholder="Password" name="SignUpPassword" />
          <button name="register" type="submit">Sign Up</button>
        </form>
      </div>
      <div class="form-container sign-in-container">
        <form action="" name="SignIn" onsubmit="return validateForm()" method="post" required>
          <h1>Sign in</h1>
          <span>or use your account</span>
          <br />
          <input type="username" placeholder="Username" name="SignInUsername" />
          <input type="password" placeholder="Password" name="SignInPassword" />
          <button name="submit" type="submit">Sign In</button>
        </form>
      </div>
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1>Welcome Back!</h1>
            <p>
              To keep connected with us please login with your personal info
            </p>
            <button class="ghost" id="signIn">Sign In</button>
          </div>
          <div class="overlay-panel overlay-right">
            <h1>Hello, Friend!</h1>
            <p>Enter your personal details and start shopping with us</p>
            <button class="ghost" id="signUp">Sign Up</button>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script src="../../core/js/main.js"></script>
  <script language="Javascript">
function validateForm() {
  var x = document.forms["SignIn"]["SignInUsername"].value;
  if (x == "") {
    alert("Username must be filled out");
    return false;
  } 
  var x = document.forms["SignIn"]["SignInPassword"].value;
  if (x == "") {
    alert("Password must be filled out");
    return false;
  }
}
function validateFormReg() {
  var x = document.forms["SignUp"]["SignUpUsername"].value;
  if (x == "") {
    alert("Username must be filled out");
    return false;
  } 
  var x = document.forms["SignUp"]["Email"].value;
  if (x == "") {
    alert("Email must be filled out");
    return false;
  }
  var x = document.forms["SignUp"]["SignUpPassword"].value;
  if (x == "") {
    alert("Password must be filled out");
    return false;
  }
}  
</script>
</html>

<?php
  $con = mysqli_connect("localhost","root","","OnlineShop");
 
  if (isset($_POST["submit"])) {
    if(!empty($_POST['SignInUsername']) && !empty($_POST['SignInPassword'])){


      $Username=$_POST['SignInUsername'];
      $Password=$_POST['SignInPassword'];
  

      $sql="select count(*) as count from User where Username= '$Username'";
      $result=mysqli_query($con, $sql) or die("Invalid query");
      $row =mysqli_fetch_array($result);



      $sql="select count(*) as count from User where Password= '$Password'";
      $resultpass =mysqli_query($con, $sql) or die("Invalid query");

      $rowpass =mysqli_fetch_array($resultpass);

      if($row[0]==1){
        $sql = "select count(*) from User where Username = '$Username' AND Password = '$Password'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        if($row[0]==1){
          echo '<script language="javascript">';
          echo 'alert("You successfully logged in")';  
          echo '</script>';
          session_start();
          $_SESSION["Username"] = $Username;
          header("Location: ../homepage/index.php");
        } else {
        echo '<script language="javascript">';
        echo 'alert("Incorrect password.")'; 
        echo '</script>';
        }
  }
  else{
    echo '<script language="javascript">';
    echo 'alert("Incorrect username.")'; 
    echo '</script>';
  }
}

}
else if(isset($_POST["register"])){
  $con = mysqli_connect("localhost","root","","OnlineShop");
 
  if (isset($_POST["register"])) {
    $Username=$_POST['SignUpUsername'];
    $password=$_POST['SignUpPassword'];
    $Email =$_POST['Email'];
    
  

    $sql="select count(*) as count from User where Username= '$Username'";
    $result=mysqli_query($con, $sql) or die('error in querying');
    $row =mysqli_fetch_array($result);
    
    if($row["count"]==0){
      $sql= "insert into User values (NULL,'$Username','$Email','$password')";
      mysqli_query($con, $sql) or die("Username not added to database");
      header('Location: ../login-and-sign-up/log-in-and-sign-up.php');
    } else {
      echo '<script language="javascript">';
      echo 'alert("Username already existing")';
      echo '</script>';
    }
    exit;
  }
else{
  echo '<script language="javascript">';
  echo 'alert("<h1>Empty fields.<h1>")'; 
  echo '</script>';
}


}
?>