<?php
session_start();
include 'Base.php';
global $base;
//Vérifier que l'utilisateur est connecté
if (isset($_SESSION['user_id'])){
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Staff Airline</title>

  </head>

  <body>
    <nav>
      <ul>
        <li><a href="">Welcome</a></li>
          <li><a href="Logout.php">Logout</a></li>
        <?php
          if($_SESSION['admin_id'] == 1){
            echo "<li><a href=\"\">Administration</a></li>";
          }


        ?>

      </ul>
    </nav>

      <h1>Username : <?php echo $_SESSION['username']; ?></h1><br>
      <h2>Email: <?php echo $_SESSION['email']; ?></h2>








  </body>
</html>
<?php
}
else{

}

?>
