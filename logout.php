<?php
  session_start();

  /** 
   * Unset all the session variables to make sure logged out.
   * After logging out redirect to login page.
   */
  if (isset($_SESSION['loggedIn']) && $_SESSION["loggedIn"]) {
    session_unset();
    session_destroy();
    header('Location:./index.php');
  }
?>
