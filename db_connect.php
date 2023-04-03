<?php

  /**
   * Including Dotenv to access env variables.
   * Access database credentials.
   */
  include './vendor/autoload.php';

  /**
   * Including database class UserDb to access database and methods.
   */
  require_once './UserDb.php';

  use Dotenv\Dotenv;
  $dotenv = Dotenv::createImmutable("./");
  $dotenv->load();

  $dbUsername = $_ENV['USERNAME'];
  $dbPassword = $_ENV['PASSWORD'];
  $dbName = $_ENV['DBNAME'];

  $database = new UserDb($dbName, $dbUsername, $dbPassword);
?>
