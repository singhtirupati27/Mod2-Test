<?php
  session_start();

  if(isset($_SESSION['loggedIn']) && $_SESSION["loggedIn"]) {
    header("Location:./welcome.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innoraft Grocery Store | Login</title>
    <link rel="stylesheet" href="./css/login.css">
  </head>
  <body>
    <?php
      require './db_connect.php';

      /*
       Including User.php to acces all methods and properties of User class.
       */
      include './User.php';
      $user = new User();

      if(isset($_POST["signin"])) {
        $email = $_POST["username"];
        $password = $_POST["password"];

        $user->validateEmail($email);
        $user->checkPassword($password);

        if($user->emailErr == "" && $user->passwordErr == "") {
          if($database->checkLogin($email, $password)) {
            $_SESSION["loggedIn"] = TRUE;
            $_SESSION["username"] = $database->getUsername($_POST["username"]);
            header("Location:./welcome.php");
          }
          else {
            $msg = "The username and password are incorrect.";
          }
        }
      }
    ?>
    <div class="main-container">
      <div class="login-container">
        <div class="page-wrapper login-wrap">
          <div class="login-content">
            <h1>Sign In</h1>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
              <div class="form-input">
                <input type="text" name="username" id="email" placeholder="Email" onblur="validateEmail()">
                <span class="error" id="checkEmail"><?php echo $user->emailErr;?></span>
              </div>
              <div class="form-input">
                <input type="text" name="password" id="password" placeholder="Password" onblur="validatePassword">
                <span class="error" id="checkPass"><?php echo $user->passwordErr;?></span>
              </div>
              <div class="form-input">
                <input type="submit" id="submit-btn" name="signin" value = "Sign In">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="./js/script.js"></script>
  </body>
</html>
