<?php

// Include necessary files and establish database connection
// require_once 'db_connection.php';
// Database connection
$host = 'localhost';
$dbname = 'staffs_airways';
$username = 'root';
$password = 'Sun@!77Jetty:com';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Fetch all unique models from the planes table
$query = "SELECT DISTINCT model FROM planes";
$stmt = $conn->prepare($query);
$stmt->execute();
$models = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch the list of planes
$query = "SELECT * FROM planes";
$allPlanes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Define initial display settings
$initialPlaneCount = 6; // Display the first 6 planes initially
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Staffs_Airways - Aircraft</title>
        <link rel="stylesheet" href="tailwind.css">
    </head>
    <body>

    <header class="bg-gray-900 bg-opacity-95 py-2">
        <div class="container mx-auto relative">
            <link rel="stylesheet" href="tailwind.css">
            <nav class="flex flex-wrap items-center px-4">
                <!-- Company Brand -->
                <a href="#" class="font-bold font-sans hover:text-opacity-75 inline-flex items-center leading-none mr-4 space-x-1 text-primary-500 text-xl uppercase">
                    <svg
                        version="1.0"
                        xmlns="http://www.w3.org/2000/svg"
                        width="2.5em"
                        xml:space="preserve"
                        fill="currentColor"
                        viewBox="0 0 100 100"
                        height="2.5em"
                    >
                        <!-- Replace this SVG with your company logo -->
                        <path d="M38.333 80a11.571 11.571 0 0 1-7.646-2.883A11.724 11.724 0 0 1 26.834 70H10V46.667L43.333 40l20-20H90v26.667H43.995l-27.328 5.465v11.2h11.166a11.787 11.787 0 0 1 4.212-4.807 11.563 11.563 0 0 1 12.577 0 11.789 11.789 0 0 1 4.213 4.807h7.833V70h-6.837a11.719 11.719 0 0 1-3.853 7.117A11.571 11.571 0 0 1 38.333 80Zm0-16.667a5 5 0 1 0 5 5 5.006 5.006 0 0 0-5.001-5Zm27.761-36.666L52.762 40h30.571V26.667Z"></path>
                    </svg>
                    <span>Staffs_Airways</span>
                </a>

                <!-- Hamburger Menu for Mobile -->
                <button
                    class="hover:bg-primary-500 hover:text-white ml-auto px-3 py-2 rounded text-white lg:hidden"
                    data-name="nav-toggler"
                >
                    <span class="block border-b-2 border-current my-1 w-6"></span>
                    <span class="block border-b-2 border-current my-1 w-6"></span>
                    <span class="block border-b-2 border-current my-1 w-6"></span>
                </button>

                <!-- Navigation Menu -->
                <div
                    class="flex-1 hidden space-y-2 w-full lg:flex lg:items-center lg:space-x-4 lg:space-y-0 lg:w-auto"
                    data-name="nav-menu"
                >
                    <!-- Main Navigation Links -->
                    <div class="flex flex-col mr-auto lg:flex-row">
                        <a href="index.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Home</a>
                        <a href="#" class="hover:text-gray-400 lg:p-4 py-2 text-white">Flights</a>
                        <a href="index.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Plane Rentals</a>
                        <a href="aircraft.php" class="hover:text-gray-400 lg:p-4 py-2 text-white">Aircraft</a>
                        <a href="#" class="hover:text-gray-400 lg:p-4 py-2 text-white">Support</a>
                    </div>

                    <!-- Log In/Sign Up -->
                    <div class="flex-wrap inline-flex items-center py-1 space-x-2">
                        <a href="#" class="border border-primary-500 hover:bg-primary-500 hover:text-white inline-block px-6 py-2 text-primary-500">Log In</a>
                        <a href="#" class="bg-primary-500 border border-primary-500 hover:bg-primary-600 inline-block px-6 py-2 text-white">Sign Up</a>
                    </div>
                </div>
            </nav>
        </div>

        <script>
            // Toggle the mobile menu when the hamburger button is clicked
            document.querySelector('[data-name="nav-toggler"]').addEventListener('click', function () {
                const navMenu = document.querySelector('[data-name="nav-menu"]');
                navMenu.classList.toggle('hidden');
            });
        </script>
    </header>

    <main>

        <section class="bg-secondary-500 poster relative text-gray-300">
            <div class="container mx-auto pb-24 pt-72 px-4">
                <div class="-mx-4 flex flex-wrap items-center space-y-6 lg:space-y-0">
                    <div class="px-4 w-full md:w-9/12 xl:w-7/12 2xl:w-6/12"> 
                        <p class="font-bold font-sans mb-1 text-2xl text-white">Find the</p>
                        <h1 class="font-bold mb-6 text-5xl text-white md:leading-tight lg:leading-tight lg:text-6xl">
                            <span class="text-primary-500">Perfect Plane</span> for <span class="text-primary-500">Your Journey</span>
                        </h1>                             
                    </div>
                </div>
            </div>
        </section>
        <!-- Introductory Section -->
        

        <!---Plane presentations--> 
        <?php
            // Fetch the initial set of planes (first 6)
            $initialCount = 6; // Initial count of planes
            $query = "SELECT * FROM planes LIMIT $initialCount"; // Fetch the first 6 planes
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $initialPlanes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            // Fetch all planes for "See More"
            $query = "SELECT * FROM planes"; // Fetch all planes
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $allPlanes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <section class="bg-gray-50 py-24">
            <div class="container mx-auto px-4">
                <div class="-mx-4 flex flex-wrap items-center mb-6">
                    <div class="px-4 w-full md:flex-1">
                        <h2 class="font-medium mb-1 text-primary-500 text-xl">Our Aircraft</h2>
                        <h3 class="capitalize font-bold mb-4 text-4xl text-gray-900">Planes for All Your Needs</h3>
                        <div class="bg-primary-500 mb-6 pb-1 w-2/12"></div>
                        <p class="text-gray-600">
                           <i><b>Explore our fleet of modern planes available for rental. Whether you're planning a business trip or a leisurely getaway, we have the perfect aircraft for you.</b></i>
                        </p>
                    </div>
                </div>

                <div class="-mx-3 flex flex-wrap justify-center mb-12" id="plane-container">
                    <?php
                        // Display initial planes (first 6)
                        for ($i = 0; $i < 6; $i++) {
                            if ($i >= count($allPlanes)) {
                                break;
                            }

                            $plane = $allPlanes[$i];

                            echo "
                            <div class='p-3 w-full md:w-6/12 lg:w-4/12'>
                                <div class='bg-white border shadow-md text-gray-500'>
                                    <a href='plane_detail.php?plane_id={$plane['plane_id']}'>
                                        <img src='IMG_6281.JPG' class='hover:opacity-90 w-full' alt='Plane' width='600' height='450' />
                                    </a>
                                    
                                    <div class='p-6'>
                                        <h4 class='font-bold mb-2 text-gray-900 text-xl'>
                                            <a href='plane_detail.php?plane_id={$plane['plane_id']}' class='hover:text-gray-500'>{$plane['model']}</a>
                                        </h4>
                                        <p class='mb-2 text-sm'>{$plane['description']}</p>
                                        <hr class='border-gray-200 my-4' />
                                        <div class='flex items-center justify-between'>
                                            <div class='inline-flex items-center py-1 space-x-1'>
                                                <span>{$plane['rating']}</span>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' width='1.125em' height='1.125em' class='text-primary-500'>
                                                    <g>
                                                        <path d='M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z'></path>
                                                    </g>
                                                </svg>
                                                <span>({$plane['number_of_reviews']} reviews)</span>
                                            </div>
                                            <p class='font-bold text-gray-900'>\${$plane['rental_price_per_hour']}/h</p>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                        }
                    ?>
                </div>

                <div class="flex justify-center mt-8">
                    <button id="plane-see-more" class="bg-primary-500 hover:bg-primary-600 px-6 py-2 text-white">
                        See More
                    </button>
                    <button id="plane-see-less" class="bg-primary-500 hover:bg-primary-600 px-6 py-2 text-white" style="display: none; margin-left: 20px">
                        See Less
                    </button>
                </div>
            </div>

            <script>
                const allPlanes = <?php echo json_encode($allPlanes); ?>;
                let currentStartIndex = 6;
                const planesPerPage = 3;

                // Function to load additional planes
                function loadPlanes(startIndex, count) {
                    const container = document.getElementById("plane-container");

                    for (let i = startIndex; i < startIndex + count; i++) {
                        if (i >= allPlanes.length) {
                            break;
                        }

                        const plane = allPlanes[i];

                        const planeDiv = document.createElement("div");
                        planeDiv.className = "p-3 w-full md:w-6/12 lg:w-4/12";

                        planeDiv.innerHTML = `
                            <div class='bg-white border shadow-md text-gray-500'>
                                <a href='#'>
                                    <img src='IMG_6289.JPG' class='hover:opacity-90 w-full' alt='Plane' width='600' height='450' />
                                </a>
                                <div class='p-6'>
                                    <h4 class='font-bold mb-2 text-gray-900 text-xl'>
                                        <a href='#' class='hover:text-gray-500'>${plane['model']}</a>
                                    </h4>
                                    <p>${plane['description']}</p>
                                    <hr class='border-gray-200 my-4' />
                                    <div class='flex items-center justify-between'>
                                        <div class='inline-flex items-center py-1 space-x-1'>
                                            <span>${plane['rating']}</span>
                                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' width='1.125em' height='1.125em' class='text-primary-500'>
                                                <g>
                                                    <path d='M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z'></path>
                                                </g>
                                            </svg>
                                            <span>(${plane['number_of_reviews']} reviews)</span>
                                        </div>
                                        <p class='font-bold text-gray-900'>$${plane['rental_price_per_hour']}/h </p>
                                    </div>
                                </div>
                            </div>`;

                        container.appendChild(planeDiv);
                    }
                }
                        
                // Function to remove planes (for "See Less")
                function removePlanes(count) {
                    const container = document.getElementById("plane-container");

                    for (let i = 0; i < count; i++) {
                        if (container.childNodes.length <= 6) {
                            break; // Don't remove if fewer than initial planes
                        }

                        container.removeChild(container.lastChild);
                    }

                    currentStartIndex -= count;
                }

                document.getElementById("plane-see-more").addEventListener("click", function() {
                    loadPlanes(currentStartIndex, planesPerPage);
                    currentStartIndex += planesPerPage;

                    if (currentStartIndex >= allPlanes.length) {
                        this.style.display = "none"; // Hide "See More" if all planes are displayed
                    }

                    document.getElementById("plane-see-less").style.display = "block"; // Show "See Less"
                });

                document.getElementById("plane-see-less").addEventListener("click", function() {
                    removePlanes(planesPerPage);

                    if (currentStartIndex < allPlanes.length) {
                        document.getElementById("plane-see-more").style.display = "block"; // Show "See More" if not all planes are displayed
                    }

                    if (currentStartIndex <= 6) {
                        this.style.display = "none"; // Hide "See Less" if only initial planes are displayed
                    }
                });
            </script>
        </section>

        <section class="bg-gray-900 bg-opacity-95 py-24 text-gray-400">
            <div class="container mx-auto px-4">
                <div class="-mx-4 flex flex-wrap items-center mb-6">
                    <div class="px-4 w-full md:w-10/12">
                        <h2 class="font-medium mb-1 text-primary-500 text-xl">Customer Testimonials</h2>
                        <h3 class="capitalize font-bold mb-4 text-4xl text-white">What Our Customers Say About Our Plane Rentals</h3>
                        <div class="bg-primary-500 mb-6 pb-1 w-2/12"></div>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-4 items-center">
                    <!-- Testimonial Image -->
                    <div class="p-4 w-full lg:w-4/12">
                        <img src="bottom3.jpg" alt="Customer Photo" width="360" height="360" />
                    </div>

                    <!-- Testimonial Text -->
                    <div class="p-4 w-full lg:w-8/12">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="h-16 inline-block mb-4 text-primary-500 w-16">
                            <path d="M23 1V5.06504C21.9136 5.67931 21.0807 6.43812 20.5012 7.34146C19.958 8.24481 19.5416 9.20235 19.2519 10.2141C18.9621 11.2258 18.8173 12.346 18.8173 13.5745H23V22.4634H14.0914V16.935C14.0914 13.6107 14.3992 11.0813 15.0148 9.34688C15.6667 7.61246 16.6444 6.02258 17.9481 4.57723C19.2519 3.09575 20.9358 1.90334 23 1ZM9.90864 1V5.06504C8.82222 5.67931 7.9893 6.43812 7.40988 7.34146C6.83045 8.24481 6.39588 9.20235 6.10617 10.2141C5.81646 11.2258 5.67161 12.346 5.67161 13.5745H9.90864V22.4634H1V16.935C1 13.6107 1.30782 11.0813 1.92346 9.34688C2.57531 7.61246 3.55309 6.02258 4.85679 4.57723C6.16049 3.09575 7.84444 1.90334 9.90864 1Z"></path>
                        </svg>

                        <!-- Testimonial Text and Customer Information -->
                        <p class="font-light mb-5 text-xl">
                            "Renting a plane from Staffs Airways was an amazing experience! The service was seamless from start to finish. Our plane was in perfect condition, and the customer support was top-notch. It made our business trip so much easier."
                        </p>
                        <h4 class="font-bold mb-1 text-2xl text-primary-500">Kathryn Murphy</h4>
                        <p class="text-white">Chief Technology Officer</p>
                    </div>
                </div>
            </div>
        </section>
            <!-- END of Customer Testimonials-->

        <section class="bg-primary-500 py-16 text-center text-gray-300"> 
            <div class="container mx-auto px-4 relative"> 
                <h2 class="capitalize font-bold mb-6 text-4xl text-white">Download Our App &amp; Get Started</h2>
                <div class="flex-wrap inline-flex items-center py-1 space-x-2"> <a href="#" class="border border-white hover:bg-white hover:inline-flex hover:items-center hover:space-x-2 hover:text-gray-900 inline-flex items-center px-6 py-2 space-x-2 text-white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1.5em" height="1.5em" fill="currentColor" class="me-1">
                            <path d="M11.624 7.222c-.876 0-2.232-.996-3.66-.96-1.884.024-3.612 1.092-4.584 2.784-1.956 3.396-.504 8.412 1.404 11.172.936 1.344 2.04 2.856 3.504 2.808 1.404-.06 1.932-.912 3.636-.912 1.692 0 2.172.912 3.66.876 1.512-.024 2.472-1.368 3.396-2.724 1.068-1.56 1.512-3.072 1.536-3.156-.036-.012-2.94-1.128-2.976-4.488-.024-2.808 2.292-4.152 2.4-4.212-1.32-1.932-3.348-2.148-4.056-2.196-1.848-.144-3.396 1.008-4.26 1.008zm3.12-2.832c.78-.936 1.296-2.244 1.152-3.54-1.116.048-2.46.744-3.264 1.68-.72.828-1.344 2.16-1.176 3.432 1.236.096 2.508-.636 3.288-1.572z"></path>
                        </svg><span>App Store</span></a><a href="#" class="border border-white hover:bg-white hover:inline-flex hover:items-center hover:space-x-2 hover:text-gray-900 inline-flex items-center px-6 py-2 space-x-2 text-white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1.5em" height="1.5em" fill="currentColor" class="me-1">
                            <path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 0 1-.61-.92V2.734a1 1 0 0 1 .609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-3.198l2.807 1.626a1 1 0 0 1 0 1.73l-2.808 1.626L15.206 12l2.492-2.491zM5.864 2.658L16.802 8.99l-2.303 2.303-8.635-8.635z"></path>
                        </svg><span>Google Play</span></a> 
                </div>                     
            </div>
        </section>
        <!-- ADDITION !!!!?????-->
        <!-- END of ADDITION !!!!?????-->

    </main>

    </body>
    <footer class="bg-black bg-opacity-90 pt-12 text-gray-300">
        <div class="container mx-auto px-4 relative">
            <div class="flex flex-wrap -mx-4">
                <!-- Company Information -->
                <div class="p-4 w-full lg:w-4/12">
                    <a href="#" class="font-bold font-sans hover:text-opacity-90 inline-flex items-center leading-none mb-4 space-x-2 text-3xl text-primary-500 uppercase">
                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="3em" xml:space="preserve" fill="currentColor" viewBox="0 0 100 100" height="3em">
                            <path d="M38.333 80a11.571 11.571 0 0 1-7.646-2.883A11.724 11.724 0 0 1 26.834 70H10V46.667L43.333 40l20-20H90v26.667H43.995l-27.328 5.465v11.2h11.166a11.787 11.787 0 0 1 4.212-4.807 11.563 11.563 0 0 1 12.577 0 11.789 11.789 0 0 1 4.213 4.807h7.833V70h-6.837a11.719 11.719 0 0 1-3.853 7.117A11.571 11.571 0 0 1 38.333 80Zm0-16.667a5 5 0 1 0 5 5 5.006 5.006 0 0 0-5.001-5Zm27.761-36.666L52.762 40h30.571V26.667Z"></path>
                            <path d="M56.667 63.333h-7.833a11.6 11.6 0 0 0-21 0H16.667v-11.2l27.328-5.465h12.672Z" opacity="0.2"></path>
                            <path d="M90 63.333H80v-10h-6.667v10h-10V70h10v10H80V70h10Z"></path>
                            <path d="M52.762 40h30.571V26.667H66.094Z" opacity="0.2"></path>
                        </svg>
                        <span>Staffs Airways</span>
                    </a>
                    <ul class="mb-4 space-y-1">
                        <li>Staffordshire University, UK</li>
                        <li><a href="#" class="hover:text-gray-400 text-white">+44 123 456 7890</a></li>
                        <li><a href="mailto:info@staffsairways.com" class="hover:text-gray-400 text-white">info@staffsairways.com</a></li>
                    </ul>
                    <div class="flex-wrap inline-flex space-x-3">
                        <a href="#" aria-label="facebook" class="hover:text-gray-400"> 
                            <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                <path d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4v-8.5z"/>
                            </svg>
                        </a>
                        <a href="#" aria-label="twitter" class="hover:text-gray-400"> 
                            <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                <path d="M22.162 5.656a8.384 8.384 0 0 1-2.402.658A4.196 4.196 0 0 0 21.6 4c-.82.488-1.719.83-2.656 1.015a4.182 4.182 0 0 0-7.126 3.814 11.874 11.874 0 0 1-8.62-4.37 4.168 4.168 0 0 0-.566 2.103c0 1.45.738 2.731 1.86 3.481a4.168 4.168 0 0 1-1.894-.523v.052a4.185 4.185 0 0 0 3.355 4.101 a4.21 4.21 0 0 1-1.89.072A4.185 4.185 0 0 0 7.97 16.65 a8.394 8.394 0 0 1-6.191 1.732 a11.83 11.83 0 0 0 6.41 1.88 c7.693 0 11.9-6.373 11.9-11.9"/>
                            </svg>
                        </a>
                        <a href="#" aria-label="instagram" class="hover:text-gray-400"> 
                            <svg viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                <path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428 a4.883 4.883 0 0 1-1.153 1.772 a4.915 4.915 a0 0 a a 2.428 3.43"/>
                            </svg>
                        </a>
                    </div>
                </div>
                    
                <!-- Company Links -->
                <div class="p-4 w-full sm:w-6/12 md:flex-1 lg:w-3/12">
                    <h2 class="font-bold text-primary-500 text-xl">Company</h2>
                    <hr class="border-gray-600 inline-block mb-6 mt-4 w-3/12">
                    <ul>
                        <li class="mb-4"><a href="#" class="hover:text-gray-400">FAQ</a></li>
                        <li class="mb-4"><a href="#" class="hover:text-gray-400">News</a></li>
                        <li class="mb-4"><a href="#" class="hover:text-gray-400">Careers</a></li>
                        <li class="mb-4"><a href="#" class="hover:text-gray-400">About Us</a></li>
                        <li class="mb-4"><a href="#" class="hover:text-gray-400">Contact Us</a></li>
                    </ul>
                </div>

                    <!-- Planes Links -->
                <div class="p-4 w-full sm:w-6/12 md:flex-1 lg:w-3/12">
                    <h2 class="font-bold text-primary-500 text-xl">Planes</h2>
                    <hr class="border-gray-600 inline-block mb-6 mt-4 w-3/12">
                    <ul>
                        <li class="mb-4"><a href="#" class="hover:text-gray-400">Private Jets</a></li>
                        <li class="mb-4"><a href="#" class="hover:text-gray-400">Commercial Airplanes</a></li>
                        <li class="mb-4"><a href="#" class="hover:text-gray-400">Charter Flights</a></li>
                        <li class="mb-4"><a href="#" class="hover:text-gray-400">Cargo Planes</a></li>
                        <li class="mb-4"><a href="#" class="hover:text-gray-400">Helicopters</a></li>
                    </ul>
                </div>

                <!-- Popular Destinations -->
                <div class="p-4 w-full md:w-5/12 lg:w-4/12">
                    <h2 class="font-bold text-primary-500 text-xl">Popular Destinations</h2>
                    <hr class="border-gray-600 inline-block mb-6 mt-4 w-3/12">
                    <div class="-mx-4 flex flex-wrap">
                        <div class="pb-4 px-4 w-full sm:w-6/12">
                            <ul>
                                <li class="mb-4"><a href="#" class="hover:text-gray-400">Paris</a></li>
                                <li class="mb-4"><a href="#" class="hover:text-gray-400">London</a></li>
                                <li class="mb-4"><a href="#" class="hover:text-gray-400">Amsterdam</a></li>
                                <li class="mb-4"><a href="#" class="hover:text-gray-400">Berlin</a></li>
                                <li class="mb-4"><a href="#" class="hover:text-gray-400">Dublin</a></li>
                            </ul>
                        </div>
                        <div class="pb-4 px-4 w-full sm:w-6/12">
                            <ul>
                                <li class="mb-4"><a href="#" class="hover:text-gray-400">Glasgow</a></li>
                                <li class="mb-4"><a href="#" class="hover:text-gray-400">Liverpool</a></li>
                                <li class="mb-4"><a href="#" class="hover:text-gray-400">Bristol</a></li>
                                <li class="mb-4"><a href="#" class="hover:text-gray-400">Manchester</a></li>
                                <li class="mb-4"><a href="#" class="hover:text-gray-400">Birmingham</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-4">
                <hr class="mb-4 opacity-25">
                <div class="flex flex-wrap -mx-4 items-center">
                    <div class="px-4 py-2 w-full md:flex-1">
                        <p>&copy; 2021 - 2024. All Rights Reserved - Staffs Airways</p>
                    </div>
                    <div class="px-4 py-2 w-full md:w-auto">
                        <a href="#" class="hover:text-gray-400">Privacy Policy</a> | 
                        <a href="#" class="hover:text-gray-400">Terms of Use</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</html>
