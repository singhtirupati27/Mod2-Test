<?php
  session_start();

  if(!isset($_SESSION['loggedIn']) && !$_SESSION["loggedIn"]) {
    header("Location:./index.php");
  }
?>
<?php require './header.php'; ?>

<div class="categories">
  <div class="page-wrapper category1-wrap">
    <div class="category1-content">
      <h1>Healthy Snacks</h1>
      <div id="category1-list">
        
      </div>
      <div class="back-btn">
        <a href="./index.php">Go Back</a>
      </div>
      <div class="save-btn">
        <a href="./cart.php">Submit</a>
      </div>
    </div>
  </div>
</div>

<?php require './footer.php'; ?>