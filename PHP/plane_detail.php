<?php
session_start();
include 'Base.php';
global $base;

// Fetch all unique models from the planes table
$query = "SELECT DISTINCT model FROM Rental_planes";
$stmt = $base->prepare($query);
$stmt->execute();
$models = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch the list of planes
$query = "SELECT * FROM Rental_planes";
$allPlanes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Define initial display settings
$initialPlaneCount = 6; // Display the first 6 planes initially
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Staffs_Airways - Aircraft</title>
        <!-- <link rel="stylesheet" href="tailwind.css"> -->
        <link rel="stylesheet"href="../CSS/tailwind.css">
    </head>
    <body>

        <header>
            <nav class="navbar">
                <div class="container1">
                <img src="../Img_logo/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo">
                <ul class="nav-links">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="plane_rental_homepage.php">Rent a Plane</a></li>
                    <li><a href="#">About Us</a></li>
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

        <main>

            <?php
                
                $plane_id = $_GET['plane_id'];

                // Fetch the plane details from the database
                $query = "SELECT * FROM Rental_planes WHERE rental_id = :plane_id";
                $stmt = $base->prepare($query);
                $stmt->bindParam(':plane_id', $plane_id, PDO::PARAM_STR);
                $stmt->execute();
                $plane = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$plane) {
                    echo "<p>Plane not found.</p>";
                    exit;
                }

                // Plane details display
            ?> 
            <section class="py-24 bg-gray-100" style="margin-bottom: 75px" >
                <div class="container mx-auto px-4" style="font-family:Verdana, Geneva, Tahoma, sans-serif">
                    <div class="-mx-4 flex flex-wrap items-center">
                        <!-- Image Section -->
                        <div class="px-4 w-full lg:w-6/12" style="margin-top: 75px; padding-bottom: 30px">
                            <img src="<?= $plane['image_path']?>" class="w-full rounded-lg" alt="<?= $plane['model'] ?>" />
                        </div>
                        <!-- Details Section -->
                        <div class="px-4 w-full lg:w-6/12"style="font-size:20px display flex">
                            <h2 class="font-bold text-3xl "><?= $plane['model'] ?></h2>
                            <p class="text-gray-600 my-4"><?= $plane['description'] ?></p>

                            <!-- Features with Icons -->
                            <div style="display: flex; height: 200px; margin-top: -40px">
                                <div class="lotdinf">
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_capacity.png" alt="Capacity Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Capacity</b>: <p style="color: black"><?= $plane['maximum_capacity'] ?> people</p>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_range.png" alt="Range Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Maximum Range</b>: <p style="color: black"><?= $plane['maximum_range'] ?> km</p>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_manufacturer.png" alt="Manufacturer Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Manufacturer</b>: <p style="color: black"><?= $plane['manufacturer'] ?></p>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_year.png" alt="Year Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Year of Manufacture</b>: <p style="color: black"><?= $plane['year_of_manufacture'] ?></p>
                                        </p>
                                    </div>
                                </div>
                                <div class="vertical-line"></div>
                                <div class="lotdinf">
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_rating.svg" alt="Rating Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Rating</b>: <p style="color: black"><?= $plane['rating'] ?></p>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_reviews.png" alt="Reviews Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Reviews</b>: <p style="color: black"><?= $plane['number_of_reviews'] ?> reviews</p>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_availability.png" alt="Availability Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Availability</b>: <p style="color: black"><?= $plane['availability_status'] ?></p>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2" style="margin-top:30px">
                                        <img src="../Img_logo/icon_price.png" alt="Price Icon" width="24" height="24" />
                                        <p class="text-gray-600 mb-1">
                                            <b>Rental Price</b>: <p style="color: black">$<?= $plane['rental_price_per_hour'] ?>/hour</p>
                                        </p>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="booking-form show">
                                <section class="bg-white py-12">
                                    <div class="container mx-auto px-6" style="max-width: 600px; margin-top: 75px;">
                                        <form class="rental-form"  action="book_plane.php" method="POST">
                                            <input type="hidden" name="plane_id" value="<?= $plane_id ?>">
                                            <div class="flex justify-between">
                                                <div class="mb-4">
                                                    <input type="text" name="departure_location" placeholder="Departure Location" class="form-input w-full border-gray-300 rounded-lg" required>
                                                </div>
                                                <div class="mb-4">
                                                    <input type="text" name="arrival_location" placeholder="Arrival Location" class="form-input w-full border-gray-300 rounded-lg" required>
                                                </div>
                                            </div>
                                            <div class="flex justify-between">
                                                <div class="mb-4 w-1/2 pr-2">
                                                    <label for="rental_date" class="text-gray-700">Date:</label>
                                                    <input type="date" name="rental_date" class="form-input w-full border-gray-300 rounded-lg" required>
                                                </div>
                                                <div class="mb-4 w-1/2 pl-2">
                                                    <label for="rental_time" class="text-gray-700">Time:</label>
                                                    <input type="time" name="rental_time" class="form-input w-full border-gray-300 rounded-lg" required>
                                                </div>
                                            </div>
                                            <div>
                                            <button type="submit" class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600">Book This Plane Now</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </section>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>



            <style>
                .bg-gray-100 {
                    background-color: #d0d1d1;
                }

                .text-gray-800 {
                color: #2d3748;
                }

                .text-gray-700 {
                color: #4a5568;
                }

                .text-gray-600 {
                color: #718096;
                }

                .text-primary-500 {
                color: #ffc300;
                }

                .bg-primary-500 {
                background-color: #ffc300;
                align-items: center;
                justify-content: center;
                }

                .hover\:bg-primary-600:hover {
                background-color: #ffa700;
                }

                .form-input {
                padding: 0.5rem 1rem;
                border: 1px solid #cbd5e0;
                border-radius: 0.5rem;
                }

                .form-input:focus {
                border-color: #3182ce;
                }

                .rounded-lg {
                border-radius: 1rem;
                }

                .shadow-lg {
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                }
                /* .container {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    max-width: 1200px;
                    margin: 0 auto;
                    padding: 0 20px;
                } */
                .rental-form {
                    width: 100%;
                    padding: 35px;
                    background-color: #001d3d;
                    border-radius: 10px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    color: #ccc;
                    font-size: 16px;
                }
                .rental-form .mb-4 {
                    flex: 1;
                    margin-right: 15px;
                }
                .rental-form .mb-4:last-child {
                    margin-right: 0;
                }
                body{
                    position: absolute ;
                }
                .statistics {
                    display: flex;
                    justify-content: space-around;
                    padding: 50px 0; /* Ajuster le padding selon vos préférences */
                    background-image: url('../Img/jet.jpg'); /* Ajouter votre image de fond */
                    background-size: cover; /* Redimensionne l'image pour couvrir toute la section */
                    background-position: center; /* Centre l'image de fond */
                }
                
                .statistic {
                    text-align: center;
                }
                .vertical-line {
                    border-left: 2px solid black;  /* Créer une bordure verticale */
                    height: 100%;  /* La bordure occupe toute la hauteur */
                    width: 1px;
                    background-color: #4a5568;
                    margin-top: 30px;
                    margin-right: 10px;
                }
                .lotdinf {
                    flex: 1;
                    padding: 10px;
                }
                .flex{
                    font-size: 15px;
                }
            </style>

        </main>

        <footer class="footer">
            <div class="footer-content">
            <div class="footer-section about">
                <img src="../Img_logo/aircraft__1_-removebg-preview.png" alt="Aircraft Image">
                <p>With STAFFS_AIRWAYS, you can easily book any ticket you need to travel safely
                thanks to our detailed system of searching and booking airline tickets.</p>
                <div class="contact">
                <span><i class="fas fa-phone"></i> +33 234 567 890</span>
                <span><i class="fas fa-envelope"></i> sttaffsairways@gmail.com</span>
                </div>
                <div class="social">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="footer-section links">
                <h2>Quick Links</h2>
                <ul>
                <li><a href="../html/home.html">Home</a></li>
                <li><a href="#">About</a></li>
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
                &copy; 2024 Airline Management System | Designed by Your Name
            </div>
        </footer>
    </body>
    
</html>
