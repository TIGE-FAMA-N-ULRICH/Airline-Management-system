<?php
  session_start();
  include 'Base.php';
  global $base;

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les valeurs du formulaire
    $plane_id = $_POST['plane_id'];
    $departure_location_id = $_POST['departure_location_id'];
    $arrival_location_id = $_POST['arrival_location_id'];
    $rental_date = $_POST['rental_date'];
    $rental_time = $_POST['rental_time'];
    $user_id = $_POST['customer_id'];
    $total_price = $_POST['total_price'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];

    $departure_location = $departure_location_id;
    $arrival_location = $arrival_location_id;
    $customer_id = $user_id;

    echo" $plane_id, $user_id, $rental_date, $rental_time, $departure_location_id, $arrival_location_id, $total_price";

    if(isset($_POST['completepayment'])){
      $sql = "INSERT INTO Bookings(plane_id, customer_id,  rental_date, rental_time, departure_location, arrival_location, total_price) VALUES (:plane_id, :customer_id, :rental_date, :rental_time, :departure_location, :arrival_location, :total_price)";

      $stmt = $base->prepare($sql);
      $params = [
          ':plane_id' => $plane_id,
          ':customer_id' => $customer_id,
          ':rental_date' => $rental_date,
          ':rental_time' => $rental_time,
          ':departure_location' => $departure_location,
          ':arrival_location' => $arrival_location,
          ':total_price' => $total_price
      ];
      $booking = $stmt->fetch(PDO::FETCH_ASSOC);

      // if ($stmt->execute($params)) {
      //   echo("Reservation successfull !");
      // } else {
      //   echo("error");
      // }
      // header("Location: Successful.php");

      // $plane_id = $booking['plane_id'] ;
      // $user_id = $booking['customer_id']; 
      // $rental_date = $booking['rental_date']; 
      // $rental_time = $booking['plane_id'];
      // $departure_location_id = $booking['departure_location'];
      // $arrival_location_id = $booking['arrival_location'];
      // $total_price = $booking['total_price'];
      
    }

  

  }

  echo" $plane_id, $user_id, $rental_date, $rental_time, $departure_location_id, $arrival_location_id, $total_price";

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
            <li><a href="aircraft.php">Plan Rental</a></li>
            <li><a href="aboutUs.php">About Us</a></li>
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
          </ul>
        </div>
      </nav>


      <?php echo" $plane_id, $user_id, $rental_date, $rental_time, $departure_location_id, $arrival_location_id, $total_price"; ?>

      <!-- <section class="booking" style="display: flex; width: 100%; justify-content: center; align-items: center;">
        <div class="booking20" style="margin-bottom:0">
            <div  style="display: flex;">
                <div class="px-4" style="margin-right: 30px; display: flex; margin-top: 20px; width: 50%" >
                    <img src="<?= $plane['image_path']?>" class=" " alt="<?= $plane['model'] ?>"  style=" width: 100%; border-radius: 20px" />
                </div>
                <div class="w-full " style="; width: 70%;">

                    <div tyle="flex">
                        <h2 class="font-bold">Payment Information</h2>
                    </div>

                    
                    <div class="" style="font-size: 12px; margin-bottom: 50px; display: flex">

                        <div class="" style="margin: 1px; display: flex"> 
                            <div class="text-lg" style="margin: 20px">
                                <b> <?= $plane['model'] ?></b>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b> <?= $departure_location['location_name'] ?></b>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b><?= $arrival_location['location_name'] ?></b>
                            </div>
                            
                            
                        </div>

                        <div class="" style=" margin: 1px; display: flex">
                            <div class="text-lg" style="margin: 20px">
                                <b><?= $rental_date ?></b>
                            </div>
                            
                            <div class="spe" style="">
                                <div class="text-lmoney" style="margin: 20px">
                                    <b> $<?= $total_price ?></b>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        
      </section> -->

  </body>
</html>

