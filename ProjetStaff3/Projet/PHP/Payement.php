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
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

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

            <form action="ProcessBooking.php" method="post">
                <h3>Payment Details</h3>
                <!-- Assuming all form fields are securely handled -->
                <label for="cardNumber">Card Number:</label>
                <input type="text" id="cardNumber" name="cardNumber" required><br>

                <label for="cardHolder">Card Holder:</label>
                <input type="text" id="cardHolder" name="cardHolder" required><br>

                <label for="expiry">Expiry Date:</label>
                <input type="month" id="expiry" name="expiry" required><br>

                <label for="cvc">CVC:</label>
                <input type="number" id="cvc" name="cvc" required><br>


                <?php
                foreach ($_POST as $key => $value) {
                    echo "<input type='hidden' name='".htmlspecialchars($key)."' value='".htmlspecialchars($value)."'>";
                    echo htmlspecialchars($key) . "    " . htmlspecialchars($value);
                }
                ?>

                <button type="submit">Confirm Payment</button>
            </form>


          </ul>
        </div>
      </nav>

  </body>
</html>
