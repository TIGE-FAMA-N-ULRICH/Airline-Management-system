<?php
    // Démarrer la session et inclure la connexion à la base de données
    session_start();
    include 'Base.php';
    global $base;

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupérer les valeurs du formulaire
        $plane_id = $_POST['plane_id'];
        $departure_location_name = $_POST['departure_location'];
        $departure_location_id = $_POST['arrival_location'];
        $rental_date = $_POST['rental_date'];
        $rental_time = $_POST['rental_time'];

        

        // Requête pour obtenir les détails de l'avion
        $stmt = $base->prepare("SELECT * FROM Rental_planes WHERE rental_id = :plane_id");
        $stmt->bindParam(':plane_id', $plane_id);
        $stmt->execute();
        $plane = $stmt->fetch(PDO::FETCH_ASSOC);

        // Assurez-vous que l'avion a été trouvé
        if (!$plane) {
            echo "Plane not found.";
            exit;
        }


        
        // Nom de l'emplacement de départ (déjà connu)
        $departure_location_name = $_POST['departure_location'];

        // Obtenir l'ID de l'emplacement de départ à partir de son nom
        $stmt = $base->prepare("SELECT location_id FROM Locations WHERE location_name = :departure_location_name");
        $stmt->bindParam(':departure_location_name', $departure_location_name);
        $stmt->execute();
        $departure_location_row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'emplacement de départ a été trouvé
        if (!$departure_location_row) {
            echo "Erreur : Emplacement de départ non trouvé.";
            exit;
        }

        // ID de l'emplacement de départ
        $departure_location_id = $departure_location_row['location_id'];

        // Obtenez les détails de l'emplacement de départ
        $stmt = $base->prepare("SELECT * FROM Locations WHERE location_id = :departure_location_id");
        $stmt->bindParam(':departure_location_id', $departure_location_id);
        $stmt->execute();
        $departure_location = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si les détails de l'emplacement de départ ont été trouvés
        if (!$departure_location) {
            echo "Erreur : Emplacement de départ non trouvé.";
            exit;
        }


        
        // ID de l'emplacement d'arrivée (déjà connu)
        $arrival_location_id = $_POST['arrival_location'];

        // Obtenez les détails de l'emplacement d'arrivée
        $stmt = $base->prepare("SELECT * FROM Locations WHERE location_id = :arrival_location_id");
        $stmt->bindParam(':arrival_location_id', $arrival_location_id);
        $stmt->execute();
        $arrival_location = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si les détails de l'emplacement d'arrivée ont été trouvés
        if (!$arrival_location) {
            echo "Erreur : Emplacement d'arrivée non trouvé.";
            exit;
        }
        

        // Vérifiez que les valeurs POST sont correctes
        if (empty($departure_location) || empty($arrival_location)) {
            echo "Error: Missing departure or arrival location.";
            exit;
        }

        $departure_latitude = $departure_location['latitude'];
        $departure_longitude = $departure_location['longitude'];
        $arrival_latitude = $arrival_location['latitude'];
        $arrival_longitude = $arrival_location['longitude'];

        // Fonction pour calculer la distance
        function haversine_distance($lat1, $lon1, $lat2, $lon2) {
            $earth_radius = 6371; // Rayon de la Terre en km
            $lat_diff = deg2rad($lat2 - $lat1);
            $lon_diff = deg2rad($lon2 - $lon1);

            $a = sin($lat_diff / 2) * sin($lat_diff / 2) +
                cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                sin($lon_diff / 2) * sin($lon_diff / 2);

            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

            return $earth_radius * $c;
        }

        // Calculer la distance et le coût
        $distance = haversine_distance(
            $departure_latitude,
            $departure_longitude,
            $arrival_latitude,
            $arrival_longitude
        );

        $cost_per_1000km = $plane['rental_price_per_hour']; // Prix par 1000 km
        $total_price = ($distance / 500) * $cost_per_1000km;

        // Arrondir le coût total
        $total_price = round($total_price, 2);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/aircraft__1_-removebg-preview.png" type="image/x-icon">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="../css/home.css">
    <script src="../js/javascript.js"></script>
</head>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
              <img src="../image/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo">
              <ul class="nav-links">
                <li><a href="home.php">Search Flights</a></li>
                <li><a href="aircraft.php">Plan Rental</a></li>
                <li><a href="aboutUs.php">About Us</a></li>
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
    </header>

    <section class="booking" style="display: flex; width: 100%; justify-content: center; align-items: center;">
        <div class="booking20" style="margin-top: 0">
            

            <div  style="display: flex;">

                <div class="px-4" style="margin-right: 30px; display: flex; margin-top: 20px; width: 50%" >
                    <img src="<?= $plane['image_path']?>" class=" " alt="<?= $plane['model'] ?>"  style=" width: 100%;" />
                </div>
                <div class="w-full " style="; width: 70%;">

                    <div tyle="flex">
                        <h2 class="font-bold">Booking Confirmation</h2>
                    </div>

                    <div class="lotdinf" style="font-size: 12px; backgroud-image: black; margin-bottom: 50px">

                        <div class="" style="margin: 1px">  <!-- Afficher les détails de la réservation -->
                            <div class="text-lg" style="margin: 20px">
                                <b>Model:</b> <?= $plane['model'] ?>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b> Date:</b> <?= $rental_date ?>
                            </div>
                            <!-- <div class="text-lg" style="margin: 20px">
                                <b>To: </b> <?= $arrival_location['location_name'] ?>
                            </div> -->
                        </div>

                        <div class="" style=" margin: 1px">
                            <div class="text-lg" style="margin: 20px">
                                <b>From: </b> <?= $departure_location['location_name'] ?>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b>Time:</b> <?= $rental_time ?>
                            </div>
                            <!-- <div class="text-lg" style="margin: 20px">
                                <b>Price: </b> $<?= $total_price ?>
                            </div> -->
                        </div>

                        <div class="" style=" margin: 1px">
                            <div class="text-lg" style="margin: 20px">
                                <b>To: </b> <?= $arrival_location['location_name'] ?>
                            </div>
                            <div class="text-lg" style="margin: 20px">
                                <b>Price: </b> $<?= $total_price ?>
                            </div>
                            <!-- <div class="text-lg" style="margin: 20px">
                                <b>Price: </b> $<?= $total_price ?>
                            </div> -->
                        <div>

                    </div>

                    
                    

                </div>
            </div>

            <div>
                <b>
                    <h3>
                        Enter you email and Username 
                    </h3>
                </b>
            </div>

            <div>
                <form class="" action="planeBooking.php" method="POST">
                    <!-- ID de l'avion -->
                    <input type="hidden" name="plane_id" value="<?= $plane['rental_id'] ?>">

                    <div style="display: flex; gap:10px">
                        <!-- Nom d'utilisateur -->
                        <div class="">
                            <input type="text" name="username" placeholder="Username" class="text-lg" required>
                        </div>

                        <!-- E-mail -->
                        <div class=""> 
                            <input type="email" name="email" placeholder="Your Email" class="text-lg" required>
                        </div>

                        <div>
                            <button class="button00" type="submit" class="">
                                Confirm Booking
                            </button>
                        </div>

                    </div>
                </form>
            </div>

            <?php
            // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //     // Retrieve data from the form
            //     $plane_id = $_POST['plane_id'];
            //     $username = $_POST['username'];
            //     $email = $_POST['email'];
            //     $user_id = null;
            
            //     // Check if the user exists
            //     $stmt = $base->prepare("SELECT * FROM Users WHERE username = :username AND email = :email");
            //     $stmt->bindParam(':username', $username);
            //     $stmt->bindParam(':email', $email);
            //     $stmt->execute();
            //     $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            //     if (!$user) {
            //         // If the user does not exist, create a new one
            //         $stmt = $base->prepare("INSERT INTO Users (username, email) VALUES (:username, :email)");
            //         $stmt->bindParam(':username', $username);
            //         $stmt->bindParam(':email', $email);
            //         $stmt->execute();
            //         $user_id = $base->lastInsertId();  // Get the ID of the new user
            //     } else {
            //         // If the user exists, get their ID
            //         $user_id = $user['user_id'];
            //     }
            
            //     // Now that we have a valid user, let's create a booking object
            //     if ($user_id) {
            //         $stmt = $base->prepare("INSERT INTO Bookings (plane_id, customer_id, rental_date, rental_time) VALUES (:plane_id, :user_id, :rental_date, :rental_time)");
            //         $stmt->bindParam(':plane_id', $plane_id);
            //         $stmt->bindParam(':user_id', $user_id);
            //         $stmt->bindParam(':rental_date', $_POST['rental_date']);
            //         $stmt->bindParam(':rental_time', $_POST['rental_time']);
            //         $stmt->execute();
            
            //         $booking_id = $base->lastInsertId();  // Get the ID of the new booking
            //     }
            // }
            ?>


            <!-- <div class="mt-6">
                <button class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600">
                    Confirm Booking
                </button>
            </div> -->
        </div>

        
    </section>

    <!-- <section >
        
        <div class="booking-summary" style="width: 100%; padding: 20px; border: 1px solid #ccc; border-radius: 10px;">
            <h2 class="font-bold">Booking Confirmation</h2>

            <div class="text-lg">
                <b>Model:</b> <?= $plane['model'] ?>
            </div>
            <div class="text-lg">
                <b>Date:</b> <?= $_POST['rental_date'] ?>
            </div>
            <div class="text-lg">
                <b>From:</b> <?= $departure_location['location_name'] ?>
            </div>
            <div class="text-lg">
                <b>To:</b> <?= $arrival_location['location_name'] ?>
            </div>
            <div class="text-lg">
                <b>Time:</b> <?= $_POST['rental_time'] ?>
            </div>
            <div class="text-lg">
                <b>Total Price:</b> $<?= round($total_price, 2) ?>
            </div>
        </div>

        
        <div class="payment-form" style="width: 100%; padding: 20px; border: 1px solid #ccc; border-radius: 10px;">
            <h2 class="font-bold">Payment Information</h2>

            <form action="process_payment.php" method="POST">
                
                <input type="hidden" name="booking_id" value="<?= $booking_id ?>">

                
                <div class="mb-4 w-full">
                    <label for="card_number" class="text-gray-700">Credit Card Number:</label>
                    <input type="text" name="card_number" placeholder="1234 5678 9012 3456" required>
                </div>

                <div class="mb-4 w-full">
                    <label for="expiration_date" class="text-gray-700">Expiration Date:</label>
                    <input type="text" name="expiration_date" placeholder="MM/YY" required>
                </div>

                <div class="mb-4 w-full">
                    <label for="cvv" class="text-gray-700">CVV:</label>
                    <input type="text" name="cvv" placeholder="123" required>
                </div>

                <button type="submit" class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600">
                    Complete Payment
                </button>
            </form>
        </div>
    </section> -->
    <p><h1>BOnjour</h1></p>
    <footer class="footer">
        <div class="footer-content">
        <div class="footer-section about">
            <img src="../image/aircraft-removebg-preview.png" alt="Aircraft Image">
            <p>With STAFFS_AIRWAYS, you can easily book any ticket you need to travel safely thanks to our detailed system of searching and booking airline tickets.</p>
            <div class="contact">
            <span><i class="fas fa-phone"></i> +33 234 567 890</span>
            <span><i class="fas fa-envelope"></i> sttaffsairways@gmail.com</span>
            </div>
        </div>
        <div class="footer-section links">
            <h2>Quick Links</h2>
            <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="aboutUs.php">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="footer-section contact-form">
            <h2>Contact Us</h2>
            <form action="#">
            <input type="email" name="email" class="text-input contact-input" placeholder="Your email address">
            <textarea name="message" class="text-input contact-input" placeholder="Your message"></textarea>
            <button type="submit" class="btn contact-btn">
                <i class="fas fa-envelope"></i>
                Send Message
            </button>
            </form>
        </div>
        </div>
        <div class="footer-bottom">
        &copy; 2024 Airline Management System | Designed by Nesrine - Caleb - Walid - Ulrich - Walker
        </div>
    </footer>
    <style>
        .text-lg{
            background-color: #ccc;
            padding: 20px;
            border-radius: 7px;
            margin: 10px;
        }
        .vertical-line {
            border-left: 2px solid black;  /* Créer une bordure verticale */
            height: 100%;  /* La bordure occupe toute la hauteur */
            width: 10px;
            background-color: #4a5568;
            margin-top: 30px;
            margin-right: 10px;
        }
        .lotdinf {
            flex: 1;
            padding: 10px;
            display: flex;
        }
        .booking20{
            flex: 1;
            padding: 10px;
        }
        .booking{
            justify-content: center;
            align-items: center;
        }
    </style>

</body>
</html>
