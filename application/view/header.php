<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innoraft Grocery | Welcome</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  </head>
  <body>

    <!-- Main container -->
    <div class="main-container">

      <!-- Navbar container -->
      <div class="navbar">
        <div class="page-wrapper">
          <div class="nav">
            <div class="nav-logo">
              <a href="/home/index">Innoraft Grocery</a>
            </div>
            <ul class="nav-ul">
              <li><a href="/home/index" style="pointer-events: none;"><?php if(isset($_SESSION["username"])) { echo $_SESSION["username"];}?></a></li>
              <li><a href="/home/index">Home</a></li>
              <li><a href="/home/signout">Sign Out</a></li>
            </ul>
          </div>
        </div>
      </div>
