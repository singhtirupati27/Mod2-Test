<?php 
  require 'application/view/header.php'; 
?>


<div class="cart-container">
  <div class="page-wrapper cart-wrap">
    <div class="cart-content">
      <div class="cart-form">
        <?php echo ( $_SESSION["totalPrice"]);?>
        <?php print_r ( $_SESSION["totalPrice"]);?>
        <form action="/order/placeOrder" method="POST">
          <div class="form-input">
            <label for="fname">Name</label>
            <input type="text" name="name" id="name" placeholder="Full Name" onblur="validateName()">
            <span class="error" id="checkName"><?php if(isset($GLOBALS["nameErr"])) { echo $GLOBALS["nameErr"]; } ?></span>
          </div>

          <div class="form-input">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Enter your email" onblur="validateEmail()">
            <span class="error" id="checkEmail"><?php if(isset($GLOBALS["emailErr"])) { echo $GLOBALS["emailErr"]; } ?></span>
          </div>

          <div class="form-input">
            <label for="phone">Contact Number</label>
            <input type="text" name="phone" id="phone" placeholder="Contact Number" onblur="validatePhone()">
            <span class="error" id="checkPhone"><?php if(isset($GLOBALS["phoneErr"])) { echo $GLOBALS["phoneErr"]; } ?></span>
          </div>

          <div class="form-input">
            <label for="bill" id="bill">Total Amount</label>
            <input type="text" name="bill" placeholder="Amount payable" value="<?php if(isset($_SESSION["totalPrice"])) { echo $_SESSION["totalPrice"]; } ?>" disabled>
          </div>

          <div class="form-input">
            <input type="submit" name="ordernow" id="submit-btn" value="Order Now">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require 'application/view/footer.php'; ?>