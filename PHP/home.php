<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/aircraft__1_-removebg-preview.png" type="image/x-icon">
    <title>Home</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <script src="../js/javascript.js"></script>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
              <!--img src="../Img_logo/aircraft-removebg-preview.png" alt="Airline Management Logo" class="logo"-->
              <ul class="nav-links">
                <li><a href="home.php">Search Flights</a></li>
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
    <section class="section">
        <div class="content">
          <p id="titre">The Sky is Waiting for You</p>
          <p>With STAFFS_AIRWAYS, you can easily book any ticket you need to travel safely </p>
          <p>thanks to our detailed system of searching and booking airline tickets.</p>
        </div>
        <div class="category-buttons">
            <button class="category-button active" data-target="book-flight-form">Book Flight</button>
            <button class="category-button" data-target="rental-plane-form">Rental Plane</button>
        </div>
        <div class="form-container">
            <div class="booking-form show" id="book-flight-form">
              <h2>Book a Flight</h2>
              <form action="#" method="post" id="flight-form">
                  <input type="checkbox" id="one-way" name="trip-type" value="one-way" checked>
                  <label for="one-way">One Way</label><br><br>
                  <div class="row">
                      <div class="col">
                          <label for="departure-city">From</label>
                          <input type="text" id="departure-city" name="departure-city" required>
                      </div>
                      <div class="col">
                          <label for="destination-city">To</label>
                          <input type="text" id="destination-city" name="destination-city" required>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col">
                          <label for="depart">Departure Date:</label>
                          <input type="date" id="depart" name="depart" required>
                      </div>
                      <div class="col" id="return-date-field">
                          <label for="return">Return Date:</label>
                          <input type="date" id="return" name="return">
                      </div>
                  </div>
                  <div class="row">
                      <div class="col">
                          <label for="class">Class:</label>
                          <select id="class" name="class">
                              <option value="economy">Economy</option>
                              <option value="business">Business</option>
                          </select>
                      </div>
                      <div class="col">
                          <label for="passengers">Number of Passengers:</label>
                          <div class="passenger-select">
                              <input type="text" id="passengers" name="passengers" value="1" readonly>
                              <div class="arrow-up"></div>
                              <div class="arrow-down"></div>
                          </div>
                      </div>
                  </div>
                  <button type="submit">Search Flight</button>
              </form>
            </div>
            <div class="rental-form" id="rental-plane-form">
                <h2>Rent a Plane</h2>
                <form action="#" method="post">


                    <div class="row">
                        <div class="col">
                            <label for="depart">Departure Date:</label>
                            <input type="date" id="depart" name="depart" required>
                        </div>
                        <div class="col">
                            <label for="return">Return Date:</label>
                            <input type="date" id="return" name="return">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="class">Plane Type</label>
                            <select id="class" name="class">
                                <option value="economy">Private Jet</option>
                                <option value="business">Business Jet</option>
                            </select>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                    <button type="submit">Book Now</button>
                </form>
            </div>
            </div>
    </section>




    <section class="features">
        <h2>FEATURES</h2>
        <h3>Top Features</h3>
        <p>Explore the unparalleled advantages that set our airline apart, ensuring an exceptional journey for every passenger.</p>

        <div class="features-grid">
            <div class="feature">
                <img src="../Img_logo/diamond-removebg-preview.png" alt="Luxury and Comfort">
                <h3>Luxury And Comfort</h3>
                <p>Experience the pinnacle of luxury and comfort with our airline, where every journey is an exquisite and pleasurable experience, meticulously crafted to exceed your expectations.</p>
            </div>

            <div class="feature">
                <img src="../Img_logo/avion-removebg-preview.png" alt="Save and Secure">
                <h3>Save And Secure</h3>
                <p>Travel with peace of mind knowing that our airline provides a safe and secure service, prioritizing your well-being every step of the way.</p>
            </div>

            <div class="feature">
                <img src="../Img_logo/1-removebg-preview.png " alt="All Over The World">
                <h3>All Over The World</h3>
                <p>Discover the world at your fingertips with our airline, providing our customers the unparalleled opportunity to travel all over the globe.</p>
            </div>
        </div>
    </section>
    <section class="about-us">
      <div class="about">
        <div class="image-container">
          <img src="../Img/about.jpeg" alt="About Us Image">
        </div>
        <div class="content">
          <h2>About Us</h2>
          <h1>Making Your Dreams Come True</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In euismod ligula ac ex tincidunt rutrum. Pellentesque euismod lorem vitae magna tincidunt tincidunt vel vel sapien.</p>
          <button>Discover More</button>
        </div>
      </div>
    </section>
<section class="services">
    <h2>SERVICES</h2>
    <h3>What We Offer</h3>
    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>

    <div class="services-grid">
        <div class="service">
            <img src="../Img_logo/luxury.png" alt="Luxury and Comfort">
            <h3>Luxury Travel</h3>
            <p>Experience the pinnacle of luxury and comfort with our airline, where every journey is an exquisite and pleasurable experience, meticulously crafted to exceed your expectations.</p>
        </div>

        <div class="service">
            <img src="../Img_logo/work-schedule.png" alt="Save and Secure">
            <h3>Flexible Schedule</h3>
            <p>Travel at your own pace with our airline, offering our customers the freedom to choose a flexible schedule that fits their needs.</p>
        </div>

        <div class="service">
            <img src="../Img_logo/low-price.png" alt="All Over The World">
            <h3>Affordable Cost</h3>
            <p>Traveling affordably is our promise. Enjoy the opportunity to explore the world with our airline without breaking the bank</p>
        </div>
        <div class="service">
            <img src="../Img_logo/seater-sofa.png" alt="Luxury and Comfort">
            <h3>Comfort Travel</h3>
            <p>"Our airline offers our customers the opportunity to travel with comfort and ease, ensuring a seamless journey from takeoff to touchdown."</p>
        </div>

        <div class="service">
            <img src="../Img_logo/delivery.png" alt="Save and Secure">
            <h3>Easy Transport</h3>
            <p>"Experience hassle-free travel with Easy Transport, where our airline provides customers with the opportunity to journey effortlessly and comfortably."</p>
        </div>

        <div class="service">
            <img src="../Img_logo/fast-service.png" alt="All Over The World">
            <h3>Fast Service</h3>
            <p>"Experience swift and efficient service with our airline, where your time is valued and every aspect of your journey is handled promptly and seamlessly."</p>
        </div>
    </div>
</section>
<section class="statistics">
    <div class="statistic">
      <div class="number">80</div>
      <div class="text">+ Happy Clients</div>
    </div>
    <div class="statistic">
      <div class="number">50</div>
      <div class="text">+ Expert Pilots</div>
    </div>
    <div class="statistic">
      <div class="number">10</div>
      <div class="text">+ Win Awards</div>
    </div>
  </section>
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
  <style>
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
    </style>



</body>
</html>
