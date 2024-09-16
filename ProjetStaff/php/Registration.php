<?php
session_start();
include 'Base.php';
global $base;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Staff Airline</title>

  </head>

  <body>
    <nav class="navbar">
        <div class="container">
          <img src="../image/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo">
          <ul class="nav-links">
            <li><a href="home.php">Search Flights</a></li>
            <li><a href="#">Plan Rental</a></li>
            <li><a href="#">About Us</a></li>
            <?php
            if(isset($_SESSION['user_id'])){
              echo "<li><a href=\"\">Profile</a></li>";
              if($_SESSION['admin_id'] == 1){
                echo "<li><a href=\"\">Admin</a></li>";
              }
              echo "<li><a href=\"Logout.php\">Logout</a></li>";
            }
            else {
              echo "<li><a href=\"Login.php\">Log In</a></li>
                    <li id=\"sign-in\"><a href=\"Registration.php\">Sign In</a></li>";
            }

            ?>

          </ul>
        </div>
      </nav>
      <h1>Registration</h1>
      <form method="post">
        <input type="text" name="username" id="username" placeholder="Your username"><br>
        <input type="email" name="email" id="email" placeholder="Your email"><br>
        <input type="password" name="password" id="password" placeholder="Your password"><br>
        <input type="password" name="cpassword" id="cpassword" placeholder="Confirm your password"><br>
        <input type="submit" name="Registration" id="Registration" value="Register">
      </form>
    <?php

    if(isset($_POST['Registration'])){

      $password = htmlspecialchars($_POST['password']);
      $cpassword = htmlspecialchars($_POST['cpassword']);
      $hash = password_hash($password, PASSWORD_BCRYPT);
      $hash2 = password_hash($cpassword, PASSWORD_BCRYPT);
      $email = htmlspecialchars($_POST['email']);
      $username = htmlspecialchars($_POST['username']);

      if(!empty($username) AND !empty($email) AND !empty($password) AND !empty($cpassword)){
          $request = $base->prepare("SELECT * FROM Users WHERE email = :email");
          $request->execute(['email' => $email]);
          $exist = $request->rowCount();
          if($exist == 0){
            $request2 = $base->prepare("SELECT * FROM Users WHERE username = :username");
            $request2->execute(['username'=> $username]);
            $exist2 = $request2->rowCount();
            if($exist2 == 0){
              if ($password == $cpassword){
                $new = $base->prepare("INSERT INTO Users(username, email, password) VALUES(:username,:email,:password)");
                $new->execute(['username' => $username, 'email' => $email, 'password' => $hash]);
                $error = "<h2>Your registration has been completed</h2>";

              }
              else{
                $error = "<h2>Your passwords do not match</h2>";
              }
            }
            else{
              $error = "<h2>This pseudonym is already used</h2>";
            }
          }
          else{
            $error = "<h2>This email is already used</h2>";
          }
      }
      else{
        $error = "<h2>All fields must be completed</h2>";
      }
    }
    if(isset($error)){
      echo $error;
      echo "<br>";
      if ($error == "<h2>Your registration has been completed</h2>"){
        echo "<h2><a href=\"Login.php\">Log in</a></h2>";
        echo "<br>";
      }
    }


    ?>
  </body>
</html>
