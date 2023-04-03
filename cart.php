<?php
  session_start();

  if(!isset($_SESSION['loggedIn']) && !$_SESSION["loggedIn"]) {
    header("Location:./index.php");
  }
?>
<?php 
  require './header.php'; 
  require './User.php';

  $user = new User();

  if(isset($_POST["submit"])) {

  }
?>


<div class="cart-container">
  <div class="page-wrapper cart-wrap">
    <div class="cart-content">
      <div class="cart-form">
        <form action="./orderplaced.php" method="POST">
          <div class="form-input">
            <label for="fname">Name</label>
            <input type="text" name="name" id="name" placeholder="Full Name" onblur="validateName()">
            <span class="error" id="checkName"><?php echo $user->nameErr; ?></span>
          </div>

          <div class="form-input">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Enter your email" onblur="validateEmail()">
            <span class="error" id="checkEmail"><?php echo $user->emailErr; ?></span>
          </div>

          <div class="form-input">
            <label for="phone">Contact Number</label>
            <input type="text" name="phone" id="phone" placeholder="Contact Number" onblur="validatePhone()">
            <span class="error" id="checkPhone"><?php echo $user->phoneErr; ?></span>
          </div>

          <div class="form-iput">
            <label for="bill">Total Amount:</label>
          </div>

          <div class="form-input">
            <input type="submit" name="submit" id="submit-btn" value="Order Now">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require './footer.php'; ?>