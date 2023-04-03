<?php

  use App\Credentials;

  class Home extends Framework {

    /**
     * Function to load landing page.
     */
    public function index() {
      session_start();

      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == TRUE) {
        $this->view("welcome");
      }
      else {
        $this->view("login");
      }
    }

    /**
     * Function to validate login and load page.
     */
    public function login() {
      session_start();

      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == TRUE) {
        $this->view("welcome");
      }
      else {
        if(isset($_POST["signin"])) {
          $this->model("User");
          $this->model("UserDb");

          $credentials = new Credentials();
          $database = new UserDb($_ENV['DBNAME'], $_ENV['USERNAME'], $_ENV['PASSWORD']);
          $user = new User();

          $user->validateEmail($_POST["username"]);
          $user->checkPassword($_POST["password"]);
  
          if($user->emailErr == "" && $user->passwordErr == "") {
            if($database->checkLogin($_POST["username"], $_POST["password"])) {
              $_SESSION["username"] = $database->getUsername($_POST["username"]);
              $_SESSION["loggedIn"] = TRUE;
              $this->view("welcome");
            }
            else {
              echo '<script>alert("The username and password are incorrect.")</script>';
              $this->view("login");
            }
          }
          else {
            $GLOBALS["emailErr"] = $user->emailErr;
            $GLOBALS["passwordErr"] = $user->passwordErr;
            $this->view("login");
          }
        }
        else {
          $this->view("login");
        }
      }

    }

    /**
     * Function to destory session when signout is invoked.
     */
    public function signout() {
      session_start();
      session_unset();
      session_destroy();
      $this->view("login");
    }

    public function page() {
      $this->error('error');
    }

  }
?>