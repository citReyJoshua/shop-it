<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Get Started!</title>
    <link rel="stylesheet" href="/core/sass/account.css" />
  </head>
  <body>
    <div class="container" id="container">
      <div class="form-container sign-up-container">
        <form action="/html/homepage/index.html">
          <h3>Create StylesWorth Account</h3>
          <span>or use your email for registration</span>
          <br />
          <input type="text" placeholder="Username" />
          <input type="email" placeholder="Email" />
          <input type="password" placeholder="Password" />
          <button>Sign Up</button>
        </form>
      </div>
      <div class="form-container sign-in-container">
        <form action="/html/homepage/index.html">
          <h1>Sign in</h1>
          <span>or use your account</span>
          <br />
          <input type="username" placeholder="Username" name="username" />
          <input type="password" placeholder="Password" name="password" />
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
  <script src="/core/js/main.js"></script>
</html>
