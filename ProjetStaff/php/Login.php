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

      <h1>LOG IN</h1>
      <form method="post">
        <input type="email" name="email" id="email" placeholder="Your email"><br>
        <input type="password" name="password" id="password" placeholder="Your password"><br>
        <input type="submit" name="login" id="login" value="Log in">
      </form>
      <h2>No account yet? Register here: <a href="Registration.php"> Registration </a></h2>
    <?php
    if(isset($_POST['login'])){
      $password = htmlspecialchars($_POST['password']);
      $hash = password_hash($password, PASSWORD_BCRYPT);
      $email = htmlspecialchars($_POST['email']);

      if(!empty($email) AND !empty($password)){
        $request = $base->prepare("SELECT * FROM Users WHERE email = :email");
        $request->execute(['email' => $email]);
        $exist = $request->rowCount();

        if($exist == 1){
          $exist = $request->fetch();

          if (password_verify($password, $exist['password'])){

            $_SESSION['user_id'] = $exist['user_id'];
            $_SESSION['username'] = $exist['username'];
            $_SESSION['email'] = $exist['email'];
            $_SESSION['admin_id'] = $exist['admin_id'];
            header("Location: Profile.php");


          }
          else{
            $erreur = "<h2>This account does not exist</h2>";
          }
        }
        else{
          $erreur = "<h2>This account does not exist</h2>";
        }

      }
      else{
        $erreur = "<h2>All fields must be completed</h2>";
      }
    }
    if(isset($erreur)){
      echo $erreur;
      echo "<br>";
    }
    ?>


  </body>
</html>
