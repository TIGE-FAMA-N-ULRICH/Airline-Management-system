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
    <nav class="navbar">
        <div class="container">
          <img src="../image/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo">
          <ul class="nav-links">
            <li><a href="home.php">Search Flights</a></li>
            <li><a href="aircraft.php">Plan Rental</a></li>
            <li><a href="aboutUs.php">About Us</a></li>
            <?php
            if(isset($_SESSION['user_id'])){
              $user_id = $_SESSION['user_id'];

              echo "<li><a href=\"Profile.php\">Profile</a></li>";
              if($_SESSION['admin_id'] == 1){
                echo "<li><a href=\"\">Admin</a></li>";
              }
              echo "<li><a href=\"Logout.php\">Logout</a></li>";
            }
            else {
              echo "<li><a href=\"Login.php\">Log In</a></li>
                    <li id=\"sign-in\"><a href=\"Registration.php\">Sign In</a></li>";
            }

            $query = "SELECT bf.*,
               df.flight_number AS departure_flight_number,
               rf.flight_number AS return_flight_number,
               dap.airport_name AS departure_airport_name1,
               aap.airport_name AS arrival_airport_name1,
               ppp.airport_name AS departure_airport_name2,
               aaa.airport_name AS arrival_airport_name2,
               df.departure_datetime AS departure_datetime1,
               rf.departure_datetime AS departure_datetime2,
               df.arrival_datetime AS return_datetime1,
               rf.arrival_datetime AS return_datetime2,
               df.flight_duration AS departure_duration,
               rf.flight_duration AS return_duration,
               bf.departure_seat AS departure_seat,
               bf.return_seat AS return_seat,
               CASE bf.insurance
                   WHEN 1 THEN 'Basic'
                   WHEN 2 THEN 'Premium'
                   ELSE 'None'
               END AS insurance,
               CASE bf.class
                   WHEN 1 THEN 'Standard +'
                   WHEN 2 THEN 'Standard Flex'
                   WHEN 3 THEN 'Business'
                   WHEN 4 THEN 'Business Flex'
                   ELSE 'Standard'
               END AS class
          FROM booking_flight bf
          LEFT JOIN Flights df ON bf.departure_flight_id = df.flight_id
          LEFT JOIN Flights rf ON bf.return_flight_id = rf.flight_id
          LEFT JOIN Airports dap ON df.departure_airport = dap.airport_id
          LEFT JOIN Airports aap ON df.arrival_airport = aap.airport_id
          LEFT JOIN Airports ppp ON rf.departure_airport = ppp.airport_id
          LEFT JOIN Airports aaa ON rf.arrival_airport = aaa.airport_id
          WHERE bf.user_id = ?";
          $stmt = $base->prepare($query);
          $stmt->bindParam(1, $user_id);
          $stmt->execute();
          if (!$stmt) {
            echo "Error in SQL execution: " . htmlspecialchars($base->errorInfo()[2]);
            exit;
          }
          $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if (!$reservations) {
              echo "No bookings found for this user.";
          } else {
              // Continue with HTML rendering
              // Your existing HTML and table rendering code goes here
          }


            ?>

          </ul>
        </div>
      </nav>

      <h1>Username : <?php echo $_SESSION['username']; ?></h1><br>
      <h2>Email: <?php echo $_SESSION['email']; ?></h2>
      <section>
    <h3>Booking Flight History</h3>
    <table>
        <thead>
            <tr>
              <th>Booking ID</th>
              <th>Flight Direction</th>
              <th>Flight Number</th>
              <th>Airport From</th>
              <th>Airport To</th>
              <th>Departure Time</th>
              <th>Arrival Time</th>
              <th>Flight Duration</th>
              <th>Seat</th>
              <th>Insurance</th>
              <th>Class</th>
              <th>Price</th>


            </tr>
        </thead>
        <tbody>
          <?php foreach ($reservations as $reservation): ?>

          <tr>
              <td><?php echo htmlspecialchars($reservation['booking_id']); ?></td>
              <td>Departure</td>
              <td><?php echo htmlspecialchars($reservation['departure_flight_number']); ?></td>
              <td><?php echo htmlspecialchars($reservation['departure_airport_name1']); ?></td>
              <td><?php echo htmlspecialchars($reservation['arrival_airport_name1']); ?></td>
              <td><?php echo htmlspecialchars($reservation['departure_datetime1']); ?></td>
              <td><?php echo htmlspecialchars($reservation['return_datetime1']); ?></td>
              <td><?php echo htmlspecialchars($reservation['departure_duration']); ?></td>
              <td><?php echo htmlspecialchars($reservation['departure_seat']); ?></td>
              <td><?php echo htmlspecialchars($reservation['insurance']); ?></td>
              <td><?php echo htmlspecialchars($reservation['class']); ?></td>
              <td>£<?php echo number_format($reservation['price'], 2); ?></td>

          </tr>

          <?php if ($reservation['return_flight_number']): ?>
          <tr>
              <td><?php echo htmlspecialchars($reservation['booking_id']); ?></td>
              <td>Return</td>
              <td><?php echo htmlspecialchars($reservation['return_flight_number']); ?></td>
              <td><?php echo htmlspecialchars($reservation['departure_airport_name2']); ?></td>
              <td><?php echo htmlspecialchars($reservation['arrival_airport_name2']); ?></td>
              <td><?php echo htmlspecialchars($reservation['departure_datetime2']); ?></td>
              <td><?php echo htmlspecialchars($reservation['return_datetime2']); ?></td>
              <td><?php echo htmlspecialchars($reservation['return_duration']); ?></td>
              <td><?php echo htmlspecialchars($reservation['return_seat']); ?></td>
              <td><?php echo htmlspecialchars($reservation['insurance']); ?></td>
              <td><?php echo htmlspecialchars($reservation['class']); ?></td>
              <td>-------------</td>

          </tr>
          <?php endif; ?>
          <?php endforeach; ?>
        </tbody>
    </table>
</section>

<h3>Booking Plane History</h3>


  </body>
</html>

<?php

}
else {
    echo "Please log in to view this page.";
} ?>
