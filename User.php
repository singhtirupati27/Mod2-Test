<?php

  /**
   * Import PHPMailer classes into the global namespace.
   * These must be at the top of your script, not inside a function
   */
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  /* Load Composer's autoloader. */
  require './vendor/autoload.php';

  class User {
    public string $name;
    public string $email;
    public string $phone;
    public string $nameErr = "";
    public string $emailErr = "";
    public string $phoneErr = "";
    public string $passwordErr = "";

    public function isEmpty($data) {
      if(empty($data)) {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    public function matchPattern($pattern, $data) {
      if(preg_match($pattern, $data)) {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    public function validateName($name) {
      $pattern = "/^[a-zA-Z][\s][a-zA-Z]+$/";

      if(!$this->isEmpty($name)) {
        if(!$this->matchPattern($pattern, $name)) {
          $this->nameErr = "Only characters allowed";
        }
        else {
          $this->name = $name;
        }
      }
      else {
        $this->nameErr = "Name field cannot be empty.";
      }
    }

    /**
     * This function will check whether the email provided is of valid format or not.
     * 
     *  @param string $email
     *    In this function email is passed as parameter.
     */
    public function validateEmail(string $email) {
      if($this->isEmpty($email)) {
        $this->emailErr = "Email is required";
      }
    
      // check if email address is well-formatted
      else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->emailErr = "Invalid email format";
      }
      else {
        $this->verifyEmail($email);
      }
    }

    /**
     * Function to verify email using an api.
     * Api will verify whether email is active or not.
     * It will check whether smtp_check is true, and valid format.
     * 
     *  @param string $email
     *    In this function email is passed as parameter.
     */
    private function verifyEmail(string $email) {
      $client = new \GuzzleHttp\Client();
      
      $response = $client->request('GET', "https://api.apilayer.com/email_verification/check?email=$email", 
        ['headers' => ['Content-Type' => 'text/plain', 'apikey'=> 'CXrsWgy81xLLXRqIBlYCGUOsIIVs3QZy']]
      );
      
      $responseReceived = $response->getBody();

      $validationResult = json_decode($responseReceived, true);

      // Check whether email format and smtp_check is valid or not.
      if ($validationResult["format_valid"] && $validationResult["smtp_check"]) {
        $this->email = $email;
      } 
      else {
        $this->emailErr = "Invalid e-mail!";
      }
    }

    /**
     * This function will send email to entered email id on form.
     * 
     *  @param string $name
     *    Holds user's first name and last name.
     * 
     *  @return string
     *    It will return the message after sending email.
     */
    public function sendEmail() {

      /* Create an instance; passing `true` enables exceptions. */
      $mail = new PHPMailer(true);

      /*
       * Server settings
       */
      try {
        
        /* Enable verbose debug output. */
        $mail->SMTPDebug = 0;
        
        /* Send using SMTP. */
        $mail->isSMTP();
        
        /* Set the SMTP server to send through. */
        $mail->Host = 'smtp.gmail.com';
        
        /* Enable SMTP authentication. */
        $mail->SMTPAuth = TRUE;
        
        /* SMTP username. */
        $mail->Username = 'photography.magnus22@gmail.com';
        
        /* SMTP password. */
        $mail->Password = 'iqvmyqpvouuxxytc';
        
        /* Enable implicit TLS encryption. */
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        
        /* TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`. */
        $mail->Port = 465; 
      
        /* Recipients email */
        $mail->setFrom('from@example.com', 'Photography');
        $mail->addAddress($this->email);
        $mail->addReplyTo('info@example.com', 'Information');
      
        /**
         * Email contents
         * Set email format to HTML
         */
        $mail->isHTML(true);
        $mail->Subject = 'Reset your password.';
        $mail->Body = 'Hi,<br><br>Forgot your password?<br>
        We received a request to reset the password for your account.<br>
        <br>To reset your password, click on the button below:<br>
        <a href="http://assignment.com/home/reset" style="color: white;background-color: #008ecf;padding: 10px 15px;display: inline-block;border-radius: 8px;text-decoration: none;">Reset password</a><br><br>
        Or copy and paste the URL into your browser:<br>
        <a href="http://assignment.com/home/reset">http://assignment.com/home/reset</a>';
        $mail->AltBody = '';

        $mail->send();

        return 'E-mail has been sent!';
      } 
      catch (Exception $e) {
        return "E-mail could not be sent.";
      }
    }

    public function validateContact($phone) {
      $pattern = "/^(\+91)[0-9]{10}$/";

      if(!$this->isEmpty($phone)) {
        if(!$this->matchPattern($pattern, $phone)) {
          $this->phoneErr = "Invalid phone number";
        }
        else {
          $this->phone = $phone;
        }
      }
      else {
        $this->phoneErr = "Phone number can not be empty.";
      }
    }

    /**
     * Function to check password format.
     * 
     *  @param string $password
     *    Hold user password to check for format.
     */
    public function checkPassword(string $password) {
      $pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/";

      if(!$password == "") {
        if(strlen($password) >= 8 && strlen($password) <= 15) {
          if(!$this->matchPattern($pattern, $password)) {
            $this->passwordErr = "Password must contain at least one lower, one upper, one numeric and one special character";
          }
        }
        else {
          $this->passwordErr = "Password length must be greater than 8 characters.";
        }
      }
      else {
        $this->passwordErr = "Password cannot be empty.";
      }
    }

  }
?>