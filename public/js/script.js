/**
 * Function make button active.
 * It will change text color and button background color.
 */
function validInput(nameId, msgId, btnId) {
  document.getElementById(nameId).style.color = 'green';
  document.getElementById(msgId).innerHTML = "";
  document.getElementById(btnId).disabled = false;
  document.getElementById(btnId).style.backgroundColor = '';
}

/**
 * Function make button inactive.
 * It will change text color and button background color.
 */
function invalidInput(nameId, btnId) {
  document.getElementById(nameId).style.color = 'red';
  document.getElementById(btnId).disabled = true;
  document.getElementById(btnId).style.backgroundColor = 'lightgrey';
}

/**
 * Function to check whether passed fields are empty or not.
 */
function emptyField(msgId, btnId) {
  document.getElementById(msgId).innerHTML = "Field cannot be empty";
  document.getElementById(btnId).disabled = true;
  document.getElementById(btnId).style.backgroundColor = 'lightgrey';
}

/**
 * Function to check name contains letters or numbers.
 */
function validateName() {
  var pattern = /^[A-Za-z\s]+$/;

  if(!document.getElementById("name").value == "") {
    if(document.getElementById("name").value.match(pattern)) {
      validInput("name", "checkName", "submit-btn");
    }
    else {
      document.getElementById("checkName").innerHTML = "Only characters are allowed!";
      invalidInput("name", "submit-btn");
    }
  }
  else {
    emptyField("checkName", "submit-btn");
  }
}

/**
 * Function to check phone number format.
 */
function validatePhone() {
  var pattern = /^(\+91)[0-9]{10}$/;

  if(!document.getElementById("phone").value == "") {
    if(document.getElementById("phone").value.match(pattern)) {
      validInput("phone", "checkPhone", "submit-btn");
    }
    else {
      document.getElementById("checkPhone").innerHTML = "Invalid contact number!";
      invalidInput("phone", "submit-btn");
    }
  }
  else {
    emptyField("checkPhone", "submit-btn");
  }
}

/**
 * Function to validate email format
 */
function validateEmail() {
  var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})$/;

  if(!document.getElementById("email").value == "") {
    if(document.getElementById("email").value.match(pattern)) {
      validInput("email", "checkEmail", "submit-btn");
    }
    else {
      document.getElementById("checkEmail").innerHTML = "Invalid email format!";
      invalidInput("email", "submit-btn");
    }
  }
  else {
    emptyField("checkEmail", "submit-btn");
  }
}

/**
 * Function to check password pattern.
 */
function validatePassword() {
  var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
  
  if(!document.getElementById("password").value == "") {
    if(document.getElementById("password").value.length < 8) {
      document.getElementById("checkPass").innerHTML = "Password length must be greater than 8 characters.";
      invalidInput("password", "submit-btn");
    }
    else {
      if(document.getElementById("password").value.match(pattern)) {
        validInput("password", "checkPass", "submit-btn");
      }
      else {
        document.getElementById("checkPass").innerHTML = "Password must contain at least one lower, one upper, one numeric and one special character";
        invalidInput("password", "submit-btn");
      }
    }
  }
  else {
    emptyField("checkPass", "submit-btn");
  }
}
