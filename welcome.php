<?php
  session_start();

  if(!isset($_SESSION['loggedIn']) && !$_SESSION["loggedIn"]) {
    header("Location:./index.php");
  }
?>
<?php require './header.php'; ?>

<div class="home-container">
  <div class="page-wrapper home-wrap">
    <div class="home-content">
      <h2>Grocery Item Category</h2>
      <div class="category">
        <ul>
          <li><a href="./healthy.php">Healthy Snacks</a></li>
          <li><a href="./unhealthy.php">Unhealthy Snacks</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php require './footer.php'; ?>