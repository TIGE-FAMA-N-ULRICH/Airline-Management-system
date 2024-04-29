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

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "<h1>Flight Search Details</h1>";
                echo "<p>Trip Type: " . htmlspecialchars(isset($_POST['trip-type']) ? $_POST['trip-type'] : "Two Ways") .
                     " / From: " . htmlspecialchars(isset($_POST['departure-city']) ? $_POST['departure-city'] : "Unknown") .
                     " / To: " . htmlspecialchars(isset($_POST['destination-city']) ? $_POST['destination-city'] : "Unknown") .
                     " / Departure Date: " . htmlspecialchars(isset($_POST['depart']) ? $_POST['depart'] : "Not set") .
                     " / Return Date: " . (isset($_POST['return']) && !empty($_POST['return']) ? htmlspecialchars($_POST['return']) : "N/A") .
                     " / Class: " . htmlspecialchars(isset($_POST['class']) ? $_POST['class'] : "Not set") .
                     " / Number of Passengers: " . htmlspecialchars(isset($_POST['passengers']) ? $_POST['passengers'] : "Not specified") . "</p>";


            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                try {
                    $base = new PDO("mysql:host=localhost;dbname=Staff_Airline", "root", "");
                    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                    $departureCity = $_POST['departure-city'];
                    $destinationCity = $_POST['destination-city'];
                    $departDate = $_POST['depart'];
                    $returnDate = $_POST['return'];
                    $passengers = $_POST['passengers'];


                    echo "<form action='#' method='post'>";


                    displayFlights($base, $departureCity, $destinationCity, $departDate, $passengers, "Departure Flights", "outbound");


                    if (!empty($returnDate)) {
                        displayFlights($base, $destinationCity, $departureCity, $returnDate, $passengers, "Return Flights", "return");
                    }


                    echo "<br><br><br>";
                    echo "<button type='submit'>Validate Selection</button>";
                    echo "</form>";

                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }

            function displayFlights($db, $fromCity, $toCity, $date, $passengers, $flightType, $flightDirection) {
                $sql = "SELECT F.flight_number, F.airline, F.departure_datetime, F.arrival_datetime, F.flight_duration, F.ticket_price, F.available_seats, F.stopover_info, F.flight_id, A1.airport_name AS departure_airport_name, A2.airport_name AS arrival_airport_name
                        FROM Flights F
                        JOIN Airports A1 ON F.departure_airport = A1.airport_id
                        JOIN Cities C1 ON A1.city_id = C1.city_id
                        JOIN Airports A2 ON F.arrival_airport = A2.airport_id
                        JOIN Cities C2 ON A2.city_id = C2.city_id
                        WHERE C1.city_name = ? AND C2.city_name = ? AND DATE(F.departure_datetime) = ? AND F.available_seats >= ?";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(1, $fromCity, PDO::PARAM_STR);
                $stmt->bindValue(2, $toCity, PDO::PARAM_STR);
                $stmt->bindValue(3, $date, PDO::PARAM_STR);
                $stmt->bindValue(4, $passengers, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<h3>$flightType</h3>";
                if (count($result) > 0) {
                  echo "<table border='1' cellspacing='0' cellpadding='10'>";
                  echo "<tr><th>Select</th><th>Flight Number</th><th>Airline</th><th>Departure Airport</th><th>Arrival Airport</th><th>Departure</th><th>Arrival</th><th>Duration</th><th>Price</th><th>Available Seats</th><th>Stopover Info</th></tr>";
                  foreach ($result as $row) {
                      echo "<tr><td><input type='radio' name='flight_$flightDirection' value='" . $row['flight_id'] . "'></td><td>" .
                           htmlspecialchars($row['flight_number']) . "</td><td>" .
                           htmlspecialchars($row['airline']) . "</td><td>" .
                           htmlspecialchars($row['departure_airport_name']) . "</td><td>" .
                           htmlspecialchars($row['arrival_airport_name']) . "</td><td>" .
                           htmlspecialchars($row['departure_datetime']) . "</td><td>" .
                           htmlspecialchars($row['arrival_datetime']) . "</td><td>" .
                           htmlspecialchars($row['flight_duration']) . "</td><td>" .
                           htmlspecialchars($row['ticket_price']) . "</td><td>" .
                           htmlspecialchars($row['available_seats']) . "</td><td>" .
                           htmlspecialchars($row['stopover_info']) ?: 'No stopovers' . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No flights found for $flightType.";
                }
            }



            ?>

          </ul>
        </div>
      </nav>

  </body>
</html>
