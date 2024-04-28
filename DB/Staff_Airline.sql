Create database Staff_Airline;
use Staff_Airline;

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




CREATE TABLE Cities (
    city_id INT AUTO_INCREMENT PRIMARY KEY,
    city_name VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL
);

CREATE TABLE Airports (
    airport_id INT AUTO_INCREMENT PRIMARY KEY,
    airport_name VARCHAR(255) NOT NULL,
    city_id INT,
    FOREIGN KEY (city_id) REFERENCES Cities(city_id)
);

INSERT INTO Cities (city_name, country) VALUES
('Ngaoundere', 'Cameroon'),
('Douala', 'Cameroon'),
('Abidjan', 'Ivory Coast'),
('Yamoussoukro', 'Ivory Coast'),
('San-Pédro', 'Ivory Coast'),
('New York', 'United States'),
('London', 'United Kingdom'),
('Paris', 'France'),
('Tokyo', 'Japan'),
('Cairo', 'Egypt'),
('Lagos', 'Nigeria'),
('Johannesburg', 'South Africa'),
('Nairobi', 'Kenya'),
('Casablanca', 'Morocco'),
('Algiers', 'Algeria'),
('Accra', 'Ghana'),
('Abuja', 'Nigeria'),
('Addis Ababa', 'Ethiopia'),
('Dar es Salaam', 'Tanzania'),
('Los Angeles', 'United States'),
('Chicago', 'United States'),
('Toronto', 'Canada'),
('Sydney', 'Australia'),
('Melbourne', 'Australia'),
('Berlin', 'Germany'),
('Madrid', 'Spain'),
('Rome', 'Italy'),
('Moscow', 'Russia'),
('Beijing', 'China'),
('Shanghai', 'China'),
('Seoul', 'South Korea'),
('Mumbai', 'India'),
('Cairo', 'Egypt'),
('Mexico City', 'Mexico'),
('Rio de Janeiro', 'Brazil'),
('São Paulo', 'Brazil'),
('Buenos Aires', 'Argentina'),
('Dubai', 'United Arab Emirates'),
('Istanbul', 'Turkey');


INSERT INTO Airports (airport_name, city_id) VALUES
-- Cameroon
('Ngaoundere Airport', 1), -- Ngaoundere, Cameroon
('Maroua-Salak Airport', 1), -- Ngaoundere, Cameroon
('Douala International Airport', 2), -- Douala, Cameroon

-- Ivory Coast
('Port Bouet Airport', 3), -- Abidjan, Ivory Coast
('Felix-Houphouët-Boigny International Airport', 3), -- Abidjan, Ivory Coast
('Yamoussoukro Airport', 4), -- Yamoussoukro, Ivory Coast
('San-Pédro Airport', 5), -- San-Pédro, Ivory Coast

-- United States
('John F. Kennedy International Airport', 6), -- New York, United States
('LaGuardia Airport', 6), -- New York, United States
('Julius Nyerere International Airport', 19), -- Dar es Salaam, Tanzania
('Los Angeles International Airport', 20),

-- United Kingdom
('Heathrow Airport', 7), -- London, United Kingdom
('Gatwick Airport', 7), -- London, United Kingdom

-- France
('Charles de Gaulle Airport', 8), -- Paris, France
('Orly Airport', 8), -- Paris, France

-- Japan
('Narita International Airport', 9), -- Tokyo, Japan
('Haneda Airport', 9), -- Tokyo, Japan

-- Egypt
('Cairo International Airport', 10), -- Cairo, Egypt
('Borg El Arab Airport', 10), -- Cairo, Egypt

-- Nigeria
('Murtala Muhammed International Airport', 11), -- Lagos, Nigeria
('Ikeja Airport', 11), -- Lagos, Nigeria
('Nnamdi Azikiwe International Airport', 17), -- Abuja, Nigeria
('Kaduna Airport', 17), -- Abuja, Nigeria

('O. R. Tambo International Airport', 12), -- Johannesburg, South Africa
('Jomo Kenyatta International Airport', 13), -- Nairobi, Kenya
('Mohammed V International Airport', 14), -- Casablanca, Morocco
('Houari Boumediene Airport', 15), -- Algiers, Algeria
('Kotoka International Airport', 16), -- Accra, Ghana
('Addis Ababa Bole International Airport', 18), -- Addis Ababa, Ethiopia
('Chicago Midway International Airport', 21), -- Chicago, United States
('Billy Bishop Toronto City Airport', 22), -- Toronto, Canada
('Sydney Airport', 23), -- Sydney, Australia
('Melbourne Airport', 24), -- Melbourne, Australia
('Berlin Brandenburg Airport', 25), -- Berlin, Germany
('Adolfo Suárez Madrid–Barajas Airport', 26), -- Madrid, Spain
('Leonardo da Vinci-Fiumicino Airport', 27), -- Rome, Italy
('Sheremetyevo International Airport', 28), -- Moscow, Russia
('Beijing Capital International Airport', 29), -- Beijing, China
('Shanghai Pudong International Airport', 30), -- Shanghai, China
('Incheon International Airport', 31), -- Seoul, South Korea
('Chhatrapati Shivaji Maharaj International Airport', 32), -- Mumbai, India
('Cairo International Airport', 33),
('Mexico City International Airport', 34), -- Mexico City, Mexico
('Rio de Janeiro/Galeão–Antonio Carlos Jobim International Airport', 35), -- Rio de Janeiro, Brazil
('São Paulo/Guarulhos–Governador André Franco Montoro International Airport', 36), -- São Paulo, Brazil
('Ministro Pistarini International Airport', 37), -- Buenos Aires, Argentina
('Dubai International Airport', 38), -- Dubai, United Arab Emirates
('Istanbul Airport', 39); -- Istanbul, Turkey





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





CREATE TABLE Commercial_plane (
    plane_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    manufacturer VARCHAR(255) NOT NULL,
    year_of_manufacture int(11) DEFAULT NULL,
    model VARCHAR(255) NOT NULL,
    registration_number VARCHAR(50) DEFAULT NULL,  
    maximum_capacity INT(11) NOT NULL,
    availability_status ENUM('available', 'booked', 'maintenance') DEFAULT 'available',
    maintenance_history TEXT DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP   
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO Commercial_plane (manufacturer, year_of_manufacture, model, registration_number, maximum_capacity, availability_status, maintenance_history) 
-- Inserting a Boeing 737
 VALUES ('Boeing', 2015, '737', 'N12345', 189, 'available', 'Regular maintenance checks'),
-- Inserting an Airbus A320
 ('Airbus', 2018, 'A320', 'N54321', 186, 'booked', 'Recent engine overhaul'),
-- Inserting a Bombardier CRJ900
 ('Bombardier', 2016, 'CRJ900', 'N98765', 90, 'maintenance', 'Scheduled maintenance in progress'),
-- Inserting a Embraer E190
 ('Embraer', 2017, 'E190', 'N24680', 114, 'available', 'No maintenance issues reported'),
-- Inserting a Boeing 777
 ('Boeing', 2019, '777', 'N77777', 396, 'available', 'Routine maintenance completed'),
-- Inserting an Airbus A350
 ('Airbus', 2020, 'A350', 'N350XX', 325, 'booked', 'Avionics system upgrade in progress'),
-- Inserting a Bombardier Global 7500
 ('Bombardier', 2021, 'Global 7500', 'N7500GL', 19, 'available', 'No maintenance required'),
-- Inserting a Embraer E195
 ('Embraer', 2018, 'E195', 'N195EM', 124, 'maintenance', 'Engine inspection scheduled'),
-- Inserting a McDonnell Douglas MD-80
 ('McDonnell Douglas', 1990, 'MD-80', 'N800MD', 172, 'available', 'Frequent maintenance due to age'),
-- Inserting a Boeing 787
 ('Boeing', 2016, '787', 'N787XX', 330, 'booked', 'Scheduled maintenance next month'),
-- Inserting an Airbus A380
 ('Airbus', 2014, 'A380', 'N380AB', 853, 'available', 'Routine checks completed'),
-- Inserting a Bombardier CRJ700
 ('Bombardier', 2017, 'CRJ700', 'N700CR', 78, 'maintenance', 'Avionics upgrade scheduled'),
-- Inserting a Embraer E175
 ('Embraer', 2019, 'E175', 'N175EM', 80, 'available', 'No issues reported'),
-- Inserting a Airbus A330
 ('Airbus', 2015, 'A330', 'N330XX', 335, 'booked', 'Scheduled engine overhaul'),
-- Inserting a Boeing 737 MAX
 ('Boeing', 2022, '737 MAX', 'N737MX', 230, 'available', 'Initial checks completed'),
-- Inserting a Bombardier Dash 8 Q400
 ('Bombardier', 2016, 'Dash 8 Q400', 'N400BD', 90, 'maintenance', 'Propeller inspection due'),
-- Inserting a Embraer E170
 ('Embraer', 2017, 'E170', 'N170EM', 76, 'available', 'Regular maintenance checks'),
-- Inserting a Airbus A319
 ('Airbus', 2018, 'A319', 'N319XX', 160, 'booked', 'Avionics upgrade scheduled'),
-- Inserting a Boeing 747
 ('Boeing', 2017, '747', 'N747XX', 467, 'available', 'Routine maintenance completed'),
-- Inserting a Bombardier CRJ1000
 ('Bombardier', 2019, 'CRJ1000', 'N100CR', 104, 'maintenance', 'Hydraulic system check due'),
-- Inserting a Embraer E145
 ('Embraer', 2016, 'E145', 'N145EM', 50, 'available', 'No issues reported'),
-- Inserting a Boeing 767
 ('Boeing', 2015, '767', 'N767XX', 375, 'booked', 'Scheduled engine overhaul'),
-- Inserting an Airbus A321
 ('Airbus', 2020, 'A321', 'N321XX', 220, 'available', 'Routine checks completed'),
-- Inserting a Bombardier CRJ200
 ('Bombardier', 2018, 'CRJ200', 'N200CR', 50, 'maintenance', 'Electrical system inspection due');













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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
   FOREIGN KEY (`plane_id`) REFERENCES `Commercial_plane`(`plane_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `Fights`
  ADD PRIMARY KEY (`flight_id`);

ALTER TABLE `Fights`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
