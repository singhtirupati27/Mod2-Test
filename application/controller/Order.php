<?php

  use App\Credentials;

  class Order extends Framework {
    
    public function cart() {
      session_start();

      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == TRUE) {
        $_SESSION["totalPrice"] = $_POST["purchase"];
        $this->view("cart");
      }
      else {
        $this->view("login");
      }
    }

    public function placeOrder() {
      session_start();

      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == TRUE) {
        $this->model("UserDb");
        $this->model("User");

        if(isset($_POST["ordernow"])) {
          $credentials = new Credentials();
          $database = new UserDb($_ENV['DBNAME'], $_ENV['USERNAME'], $_ENV['PASSWORD']);
          $user = new User();
  
          $user->validateName($_POST["name"]);
          $user->validateEmail($_POST["email"]);
          $user->validateContact($_POST["phone"]);
          
          if($user->nameErr == "" && $user->phoneErr == "" && $user->emailErr == "") {
            $this->view("orderplaced");
          }
          else {
            $GLOBALS["nameErr"] = $user->nameErr;
            $GLOBALS["emailErr"] = $user->emailErr;
            $GLOBALS["phoneErr"] = $user->phoneErr;
            $this->view("cart");
          }
        }
        else {
          $this->view("cart");
        } 
      }
      else {
        $this->view("login");
      }
    }
  }

?>