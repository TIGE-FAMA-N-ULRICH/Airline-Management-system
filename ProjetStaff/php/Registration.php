<?php
session_start();
include 'Base.php';
global $base;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log in</title>
  <link rel="stylesheet" href="../css/login.css">
</head>
<body>
  <div class="container">
    <form class="login-form" action="#" method="POST">
      <h2>Sing in</h2>
      <div class="input-group">
        <label for="username">Name</label>
        <input type="text" name="username" id="username" placeholder="Your username">
      </div>

      <div class="input-group">
        <label for="email">E-mail :</label>
        <input type="email" name="email" id="email" placeholder="Your email">
      </div>

      
      <div class="input-group">
        <label for="password">password:</label>
        <input type="password" name="password" id="password" placeholder="Your password">
      </div>

      <div class="input-group">
        <label for="password">password:</label>
        <input type="password" name="cpassword" id="cpassword" placeholder="Confirm your password"><br>
      </div>

      <div class="button">
        <button type="submit" name="Registration" id="Registration" value="Sing in" class="Registration">Sing in</button>
      </div>
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
                $error = '<h3 class="yess">Your registration has been completed</h3>';

              }
              else{
                $error = '<h3>Your passwords do not match</h3>';
              }
            }
            else{
              $error = '<h3>This pseudonym is already used</h3>';
            }
          }
          else{
            $error = '<h3>This email is already used</h3>';
          }
      }
      else{
        $error = '<h3>All fields must be completed</h3>';
      }
    }
    if(isset($error)){
      echo $error;
      if ($error == '<h3 class="yess">Your registration has been completed</h3>'){
        echo '<h3><a href="Login.php" class="log">Log in</a></h3>';
      }
    }


    ?>
    </form>
    
   
  </div>
</body>
</html>
