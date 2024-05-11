<?php
session_start();
include '../php/Base.php';
global $base;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../image/aircraft__1_-removebg-preview.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../css/aide.css">
  <title>Admin</title>
</head>

<body>
  <script src="../js/aide.js"></script>

  <header>
    <nav class="navbar">
      <div class="container">
        <img src="../image/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo">
        <ul class="nav-links">
          <li><a href="home.php">Search Flights</a></li>
          <li><a href="aircraft.php">Plan Rental</a></li>
          <li><a href="aboutUs.php">About Us</a></li>
          <?php
          if (isset($_SESSION['user_id'])) {
            echo "<li><a href=\"\">Profile</a></li>";
            if ($_SESSION['admin_id'] == 1) {
              echo "<li><a href=\"\">Admin</a></li>";
            }
            echo "<li><a href=\"Logout.php\">Logout</a></li>";
          } else {
            echo "<li><a href=\"Login.php\">Log In</a></li>
                          <li id=\"sign-in\"><a href=\"Registration.php\">Sign In</a></li>";
          }

          ?>
        </ul>
      </div>
    </nav>
  </header>

  <section class="corps">
    <section class="head">
      <button class="button clicked" id="bouton_flights">FLIGHT</button>
      <button class="button" id="bouton_bookings">BOOKINGS</button>
      <button class="button" id="bouton_rent_bookings">PLANNED RENTAL</button>
      <button class="button" id="bouton_commercial_planes">COMMERCIAL PLANES</button>
      <button class="button" id="bouton_planes_rent">PLANE FOR RENT</button>
      <button class="button" id="bouton_locations">LOCATIONS</button>
      <button class="button" id="bouton_cities">CITIES</button>
      <button class="button" id="bouton_airports">AIRPORTS</button>
      <button class="button" id="bouton_users">USERS</button>
    </section>

    <div class="management" id="page_flights" style="display: block;" >

      <div class="header-container">
        <h2>FLIGHTS TABLE</h2>
        <div class="search-container">
          <select id="searchColumn"></select>
          <input type="text" id="searchInput" name="search" onkeyup="searchTable()" placeholder="       Search...">
          <span class="search-icon" id="search-icon_flights">&#128269;</span>
        </div>
      </div>

      <table id='flightTable'>
        <tr>
          <th style="width: 90px; min-height: 50px;">Flight ID</th>
          <th style="width: 94px; min-height: 50px;">Plane ID</th>
          <th style="width: 115px; min-height: 50px;">Airline</th>
          <th style="width: 102px; min-height: 50px;">Flight Number</th>
          <th style="width: 108px; min-height: 50px;">Departure Airport</th>
          <th style="width: 97px; min-height: 50px;">Arrival Airport</th>
          <th style="width: 108px; min-height: 50px;">Departure Datetime</th>
          <th style="width: 104px; min-height: 50px;">Arrival Datetime</th>
          <th style="width: 104px; min-height: 50px;">Flight Duration</th>
          <th style="width: 107px; min-height: 50px;">Flight Status</th>
          <th style="width: 97px; min-height: 50px;">Ticket Price</th>
          <th style="width: 104px; min-height: 50px;">Available Seats</th>
          <th style="width: 112px; min-height: 50px;">Stopover Info</th>
          <th style="width: 102px; min-height: 50px;">Created At</th>
        </tr>

        <?php


        try {


          // Requête SQL pour récupérer les enregistrements de la table Flights
          $sql = "SELECT * FROM Flights";
          $stmt = $base->query($sql);

          // Si la requête renvoie des résultats
          if ($stmt->rowCount() > 0) {
            // Parcourir chaque ligne de résultats
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              // Afficher chaque enregistrement dans une ligne de tableau
              echo "<tr>";
              foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
              }
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='14'>No data found</td></tr>";
          }
        } catch (PDOException $e) {
          echo "Erreur : " . $e->getMessage();
        }

        ?>

      </table>

    </div>

    <div class="management" id="page_bookings" style="display: none;">
      <div class="header-container">
        <h2>BOOKING</h2>
        <div class="search-container">
          <select id="searchBookings"></select>
          <input type="text" id="searchInput" name="search" onkeyup="searchTable()" placeholder="       Search...">
          <span class="search-icon" id="search-icon_bookings">&#128269;</span>
        </div>
      </div>


      <table id="bookingsTable">
        <tr>
          <th>Booking ID</th>
          <th>User ID</th>
          <th>Departure Flight ID</th>
          <th>Return Flight ID</th>
          <th>Booking Date</th>
          <th>Number of Passengers</th>
          <th>Status</th>
          <th>Price</th>
          <th>Seats</th>
          <th>Special Requests</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Sky Priority</th>
          <th>Checked Baggage</th>
          <th>Cabin Baggage</th>
          <th>Cabin Baggage Return</th>
          <th>Refundable</th>
          <th>Front Seats</th>
          <th>Insurance</th>
          <th>Class</th>
        </tr>

        <?php


        try {


          // Requête SQL pour récupérer les enregistrements de la table Flights
          $requete = "SELECT * FROM booking_flight";
          $resultat = $base->query($requete);

          // Si la requête renvoie des résultats
          if ($resultat->rowCount() > 0) {
            // Parcourir chaque ligne de résultats
            while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>";
              foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
              }
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='20'>No data found</td></tr>";
          }
        } catch (PDOException $e) {
          echo "Erreur : " . $e->getMessage();
        }

        ?>

      </table>


    </div>

    <div class="management" id="page_rent_bookings" style="display: none;">
      <div class="header-container">
        <h2>FLIGHTS TABLE</h2>
        <div class="search-container">
          <select id="searchRentBook"></select>
          <input type="text" id="searchInput" name="search" onkeyup="searchTable()" placeholder="       Search...">
          <span class="search-icon" id="search-iconRtenBook">&#128269;</span>
        </div>
      </div>
      <table id="rentBookTable">
            <tr>
                <th>Booking ID</th>
                <th>Plane ID</th>
                <th>Customer ID</th>
                <th>Booking Date</th>
                <th>Rental Start Date</th>
                <th>Rental End Date</th>
                <th>Departure Location</th>
                <th>Arrival Location</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Notes</th>
            </tr>

        <?php


        try {

          // Requête SQL pour récupérer les enregistrements de la table Flights
          $requete = "SELECT * FROM bookings";
          $resultat = $base->query($requete);

          // Si la requête renvoie des résultats
          if ($resultat->rowCount() > 0) {
            // Parcourir chaque ligne de résultats
            while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>";
              foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
              }
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='11'>No data found</td></tr>";
          }
        } catch (PDOException $e) {
          echo "Error : Not found";
        }

        ?>

      </table>
    </div>

    <div class="management" id="page_commercial_planes" style="display: none;">
      <div class="header-container">
        <h2>FLIGHTS TABLE</h2>
        <div class="search-container">
          <select id="searchColumn"></select>
          <input type="text" id="searchInput" name="search" onkeyup="searchTable()" placeholder="       Search...">
          <span class="search-icon">&#128269;</span>
        </div>
      </div>
    </div>


    <div class="management" id="page_planes_rent" style="display: none;">
      <div class="header-container">
        <h2>FLIGHTS TABLE</h2>
        <div class="search-container">
          <select id="searchColumn"></select>
          <input type="text" id="searchInput" name="search" onkeyup="searchTable()" placeholder="       Search...">
          <span class="search-icon">&#128269;</span>
        </div>
      </div>
    </div>


    <div class="management" id="page_locations" style="display: none;">
      <div class="header-container">
        <h2>FLIGHTS TABLE</h2>
        <div class="search-container">
          <select id="searchColumn"></select>
          <input type="text" id="searchInput" name="search" onkeyup="searchTable()" placeholder="       Search...">
          <span class="search-icon">&#128269;</span>
        </div>
      </div>
    </div>


    <div class="management" id="page_cities" style="display: none;">
      <div class="header-container">
        <h2>FLIGHTS TABLE</h2>
        <div class="search-container">
          <select id="searchColumn"></select>
          <input type="text" id="searchInput" name="search" onkeyup="searchTable()" placeholder="       Search...">
          <span class="search-icon">&#128269;</span>
        </div>
      </div>
    </div>


    <div class="management" id="page_airports" style="display: none;">
      <div class="header-container">
        <h2>FLIGHTS TABLE</h2>
        <div class="search-container">
          <select id="searchColumn"></select>
          <input type="text" id="searchInput" name="search" onkeyup="searchTable()" placeholder="       Search...">
          <span class="search-icon">&#128269;</span>
        </div>
      </div>
    </div>


    <div class="management" id="page__users" style="display: none;">
      <div class="header-container">
        <h2>FLIGHTS TABLE</h2>
        <div class="search-container">
          <select id="searchColumn"></select>
          <input type="text" id="searchInput" name="search" onkeyup="searchTable()" placeholder="       Search...">
          <span class="search-icon">&#128269;</span>
        </div>
      </div>
    </div>



  </section>




</body>
<script src="../js/aide.js"></script>

</html>