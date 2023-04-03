<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innoraft Grocery Store | Login</title>
    <link rel="stylesheet" href="/public/css/login.css">
  </head>
  <body>
    <div class="main-container">
      <div class="login-container">
        <div class="page-wrapper login-wrap">
          <div class="login-content">
            <h1>Sign In</h1>

            <form action="/home/login" method="POST">
              <div class="form-input">
                <input type="text" name="username" id="email" placeholder="Email" onblur="validateEmail()">
                <span class="error" id="checkEmail"><?php if(isset($GLOBALS["emailErr"])) { echo $$GLOBALS["emailErr"]; } ?></span>
              </div>
              <div class="form-input">
                <input type="text" name="password" id="password" placeholder="Password" onblur="validatePassword()">
                <span class="error" id="checkPass"><?php if(isset($GLOBALS["passwordErr"])) { echo $GLOBALS["passwordErr"]; } ?></span>
              </div>
              <div class="form-input">
                <input type="submit" id="submit-btn" name="signin" value = "Sign In">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="/public/js/script.js"></script>
  </body>
</html>
