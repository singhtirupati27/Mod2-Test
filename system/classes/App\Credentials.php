<?php
  namespace App;
  /**
   * Including Dotenv to access env variables.
   * Access database credentials.
   */
  require 'vendor/autoload.php';

  use Dotenv\Dotenv;

  class Credentials {

    public function __construct() {
      $dotenv = Dotenv::createImmutable("./");
      $dotenv->load();
    
      $_ENV['USERNAME'];
      $_ENV['PASSWORD'];
      $_ENV['DBNAME'];
    }

  }
  
?>
