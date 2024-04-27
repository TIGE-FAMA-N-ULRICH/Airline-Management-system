
CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin_id` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);


ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

CREATE TABLE `Fights` (
  `flight_id` int(11) NOT NULL,
  `plane_id` int(11) NOT NULL,
  `airline` varchar(255) NOT NULL,
  `flight_number` varchar(255) NOT NULL,
  `departure_airport` varchar(255) NOT NULL,
  `arrival_airport` varchar(255) NOT NULL,
  `departure_datetime` datetime NOT NULL,
  `arrival_datetime` datetime NOT NULL,
  `flight_duration` time DEFAULT NULL,
  `aircraft_type` varchar(255) DEFAULT NULL,
  `flight_status` varchar(50) DEFAULT NULL,
  `ticket_price` decimal(10,2) DEFAULT NULL,
  `available_seats` int(11) DEFAULT NULL,
  `stopover_info` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `Fights`
  ADD PRIMARY KEY (`flight_id`);

--
ALTER TABLE `Fights`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `Rental_planes` (
  `rental_id` int(11) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year_of_manufacture` int(11) DEFAULT NULL,
  `registration_number` varchar(50) DEFAULT NULL,
  `maximum_capacity` int(11) NOT NULL,
  `maximum_range` int(11) DEFAULT NULL,
  `rental_price_per_hour` decimal(10,2) NOT NULL,
  `availability_status` enum('available','booked','maintenance') DEFAULT 'available',
  `maintenance_history` text DEFAULT NULL,
  `features` text DEFAULT NULL,
  `detailed_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `number_of_reviews` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `Rental_planes`
  ADD PRIMARY KEY (`rental_id`);


ALTER TABLE `Rental_planes`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
