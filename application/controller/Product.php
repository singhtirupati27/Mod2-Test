<?php

  use App\Credentials;

  class Product extends Framework {

    /**
     * Function to load category one page.
     */
    public function category1() {
      session_start();

      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == TRUE) {
        $this->view("healthy");
      }
      else {
        $this->view("login");
      }
    }

    /**
     * Function to load category two page.
     */
    public function category2() {
      session_start();

      if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == TRUE) {
        $this->view("unhealthy");
      }
      else {
        $this->view("login");
      }
    }

    /**
     * Function to list category one items on page.
     */
    public function fetchCategory1Item() {
      session_start();

      $this->model("UserDb");

      $credentials = new Credentials();
      $database = new UserDb($_ENV['DBNAME'], $_ENV['USERNAME'], $_ENV['PASSWORD']);

      $response = $database->getCategory1();

      echo $response[0];
      echo $response[1];
    }

    /**
     * Function to list category two items on page.
     */
    public function fetchCategory2Item() {
      session_start();

      $this->model("UserDb");

      $credentials = new Credentials();
      $database = new UserDb($_ENV['DBNAME'], $_ENV['USERNAME'], $_ENV['PASSWORD']);

      $response = $database->getCategory2();

      echo $response[0];
      echo $response[1];
    }

  }

?>