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
                $selectedOutboundFlightId = isset($_POST['selected_outbound']) ? $_POST['selected_outbound'] : null;
                $selectedReturnFlightId = isset($_POST['selected_return']) ? $_POST['selected_return'] : null;

                if ($selectedOutboundFlightId) {
                    displayFlightDetails($selectedOutboundFlightId, "Departure");
                }

                if ($selectedReturnFlightId) {
                    displayFlightDetails($selectedReturnFlightId, "Return");
                }
            }

            function displayFlightDetails($flightId, $flightType) {
                global $base;


                $query = "SELECT F.flight_number, F.airline, F.departure_datetime, F.arrival_datetime, F.flight_duration, F.ticket_price, F.available_seats, F.stopover_info, A1.airport_name AS departure_airport_name, A2.airport_name AS arrival_airport_name
                          FROM Flights F
                          JOIN Airports A1 ON F.departure_airport = A1.airport_id
                          JOIN Airports A2 ON F.arrival_airport = A2.airport_id
                          WHERE F.flight_id = ?";
                $stmt = $base->prepare($query);
                $stmt->execute([$flightId]);
                $flight = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($flight) {
                    $class = $_POST['class'] ?? 'economy';
                    $passengers = $_POST['passengers'];
                    $originalPrice = (float)$flight['ticket_price'];
                    $adjustedPrice = $class === 'business' ? $originalPrice * 2 : $originalPrice;
                    $adjustedPrice2 = $adjustedPrice * $passengers;
                    echo "<h2>" . htmlspecialchars($flightType) . " Flight Details</h2>";
                    echo "<p>Flight Number: " . htmlspecialchars($flight['flight_number']) . "</p>";
                    echo "<p>Airline: " . htmlspecialchars($flight['airline']) . "</p>";
                    echo "<p>Departure Airport: " . htmlspecialchars($flight['departure_airport_name']) . " at " . htmlspecialchars($flight['departure_datetime']) . "</p>";
                    echo "<p>Arrival Airport: " . htmlspecialchars($flight['arrival_airport_name']) . " at " . htmlspecialchars($flight['arrival_datetime']) . "</p>";
                    echo "<p>Duration: " . htmlspecialchars($flight['flight_duration']) . "</p>";
                    echo "<p>Price: £" . $adjustedPrice2 . "</p>";
                    echo "<p>Available Seats: " . htmlspecialchars($flight['available_seats']) . "</p>";
                    echo "<p>Stopover Info: " . (!empty($flight['stopover_info']) ? htmlspecialchars($flight['stopover_info']) : 'No Stopovers') . "</p>";
                    return $flight['ticket_price'];
                } else {
                    echo "<p>No details available for this flight.</p>";
                }

            }

            function displayFlightDetails2($flightId, $flightType) {
                global $base;


                $query = "SELECT F.flight_number, F.airline, F.departure_datetime, F.arrival_datetime, F.flight_duration, F.ticket_price, F.available_seats, F.stopover_info, A1.airport_name AS departure_airport_name, A2.airport_name AS arrival_airport_name
                          FROM Flights F
                          JOIN Airports A1 ON F.departure_airport = A1.airport_id
                          JOIN Airports A2 ON F.arrival_airport = A2.airport_id
                          WHERE F.flight_id = ?";
                $stmt = $base->prepare($query);
                $stmt->execute([$flightId]);
                $flight = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($flight) {
                    return $flight['ticket_price'];
                }
                else {

                }

            }

            $passengers = $_POST['passengers'];
            $class = $_POST['class'] ?? 'economy';
            $priceOutbound = displayFlightDetails2($selectedOutboundFlightId, "Departure");
            $priceReturn = displayFlightDetails2($selectedReturnFlightId, "Return") ?? 0;
            $totalPrice = $priceOutbound + $priceReturn;
            $totalPrice = $totalPrice * $passengers;


            if ($class === 'business') {
                $totalPrice = $totalPrice * 2;

                echo "<h3>Business Class</h3>";
                echo "<form action='Payement.php' method='post'>";
                echo "<table border='1'>";
                echo "<tr><th>Select</th><th>Option</th><th>2 Carry-on Bags (18 kg)</th><th>2 Checked Bags (32 kg)</th><th>Front Cabin Seats</th><th>Refundable</th><th>Lounge Access</th><th>Sky Priority</th><th>Price</th></tr>";

                echo "<tr><td><input type='radio' name='selected_option' value='Business' checked></td><td>Business</td><td>Yes</td><td>Yes</td><td>Yes</td><td>No</td><td>Yes</td><td>Yes</td><td>".$totalPrice. "</td></tr>";

                echo "<tr><td><input type='radio' name='selected_option' value='Business Flex'></td><td>Business Flex</td><td>Yes</td><td>Yes</td><td>Yes</td><td>Yes</td><td>Yes</td><td>Yes</td><td>".$totalPrice + 100 . "</td></tr>";

                echo "</table>";
                echo "<h3>Insurance Options</h3>";
                echo "<table border='1'>";
                echo "<tr><th>Select</th><th>Insurance Type</th><th>Description</th><th>Price</th></tr>";
                echo "<tr><td><input type='radio' name='selected_insurance' value='None' checked></td><td>None</td><td>No insurance coverage selected</td><td>£0</td></tr>";
                echo "<tr><td><input type='radio' name='selected_insurance' value='Basic'></td><td>Basic</td><td>Covers lost luggage</td><td>£20</td></tr>";
                echo "<tr><td><input type='radio' name='selected_insurance' value='Premium'></td><td>Premium</td><td>Includes medical expenses and trip interruption</td><td>£40</td></tr>";
                echo "</table>";
                echo "<br>";
                echo "<h3>Passenger Details</h3>";

                for ($i = 1; $i <= $passengers; $i++) {
                    echo "<div style='margin-bottom: 20px;'>";
                    echo "<h4>Passenger $i</h4>";
                    echo "<label for='email$i'>Email:</label>";
                    echo "<input type='email' name='email$i' required><br>";

                    echo "<label for='first_name$i'>First Name:</label>";
                    echo "<input type='text' name='first_name$i' required><br>";

                    echo "<label for='last_name$i'>Last Name:</label>";
                    echo "<input type='text' name='last_name$i' required><br>";

                    echo "<label for='age$i'>Age:</label>";
                    echo "<input type='number' name='age$i' min='0' required><br>";

                    echo "<label for='phone$i'>Phone Number:</label>";
                    echo "<input type='tel' name='phone$i' required>";
                    echo "</div>";
                }
                foreach ($_POST as $key => $value) {
                    echo "<input type='hidden' name='".htmlspecialchars($key)."' value='".htmlspecialchars($value)."'>";
                }

                echo "<button type='submit'>Submit Your Choice</button>";
                echo "</form>";

            } else {

                echo "<h3>Economy Class</h3>";
                echo "<form action='Payement.php' method='post'>";
                echo "<table border='1'>";
                echo "<tr><th>Select</th><th>Option</th><th>Carry-on Bag (12 kg)</th><th>Checked Bag (23 kg)</th><th>Front Cabin Seats</th><th>Refundable</th><th>Lounge Access</th><th>Sky Priority</th><th>Price</th></tr>";

                echo "<tr><td><input type='radio' name='selected_option' value='Standard' checked></td><td>Standard</td><td>Yes</td><td>No</td><td>No</td><td>No</td><td>No</td><td>No</td><td>".$totalPrice. "</td></tr>";

                echo "<tr><td><input type='radio' name='selected_option' value='Standard +'></td><td>Standard +</td><td>Yes</td><td>Yes</td><td>No</td><td>No</td><td>No</td><td>No</td><td>".$totalPrice + 50 . "</td></tr>";

                echo "<tr><td><input type='radio' name='selected_option' value='Standard Flex'></td><td>Standard Flex</td><td>Yes</td><td>Yes</td><td>Yes</td><td>Yes</td><td>No</td><td>No</td><td>".$totalPrice + 150 . "</td></tr>";

                echo "</table>";
                echo "<h3>Insurance Options</h3>";
                echo "<table border='1'>";
                echo "<tr><th>Select</th><th>Insurance Type</th><th>Description</th><th>Price</th></tr>";
                echo "<tr><td><input type='radio' name='selected_insurance' value='None' checked></td><td>None</td><td>No insurance coverage selected</td><td>£0</td></tr>";
                echo "<tr><td><input type='radio' name='selected_insurance' value='Basic'></td><td>Basic</td><td>Covers lost luggage</td><td>£20</td></tr>";
                echo "<tr><td><input type='radio' name='selected_insurance' value='Premium'></td><td>Premium</td><td>Includes medical expenses and trip interruption</td><td>£40</td></tr>";
                echo "</table>";
                echo "<br>";
                echo "<h3>Passenger Details</h3>";

                for ($i = 1; $i <= $passengers; $i++) {
                    echo "<div style='margin-bottom: 20px;'>";
                    echo "<h4>Passenger $i</h4>";
                    echo "<label for='email$i'>Email:</label>";
                    echo "<input type='email' name='email$i' required><br>";

                    echo "<label for='first_name$i'>First Name:</label>";
                    echo "<input type='text' name='first_name$i' required><br>";

                    echo "<label for='last_name$i'>Last Name:</label>";
                    echo "<input type='text' name='last_name$i' required><br>";

                    echo "<label for='age$i'>Age:</label>";
                    echo "<input type='number' name='age$i' min='0' required><br>";

                    echo "<label for='phone$i'>Phone Number:</label>";
                    echo "<input type='tel' name='phone$i' required>";
                    echo "</div>";
                }
                foreach ($_POST as $key => $value) {
                    echo "<input type='hidden' name='".htmlspecialchars($key)."' value='".htmlspecialchars($value)."'>";
                }

                echo "<button type='submit'>Submit Your Choice</button>";
                echo "</form>";

            }

            ?>











          </ul>
        </div>
      </nav>

  </body>
</html>
