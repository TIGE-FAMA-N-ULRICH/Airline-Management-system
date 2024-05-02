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
      <h2>Log in</h2>
      <div class="input-group">
        <label for="email">username :</label>
        <input type="email" name="email" id="email" placeholder="Your email">
      </div>
      
      <div class="input-group">
        <label for="password">password:</label>
        <input type="password" name="password" id="password" placeholder="Your password"><br>
      </div>
      <div class="button">
        <button type="submit" name="login" id="login" value="Log in" class="login">Log in</button>
      </div>
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
          $erreur = "<h3>This account does not exist</h3>";
        }
      }
      else{
        $erreur = "<h3>This account does not exist</h3>";
      }

    }
    else{
      $erreur = "<h3>All fields must be completed</h3>";
    }
  }
  if(isset($erreur)){
    echo $erreur;
    echo "<br>";
  }
  ?>
  <h3 class="reg">No account yet ? Register here: <a href="Registration.php"> Registration </a></h3>
    </form>
    
   
  </div>
</body>
</html>
