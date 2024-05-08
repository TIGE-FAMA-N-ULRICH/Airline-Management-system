use staffs_airways;

CREATE TABLE `Rental_planes` (
  `rental_id` int(11) NOT NULL AUTO_INCREMENT,  
  `manufacturer` varchar(255) NOT NULL,        
  `model` varchar(255) NOT NULL,               
  `year_of_manufacture` int(11) DEFAULT NULL,  
  `registration_number` varchar(50) UNIQUE,    
  `maximum_capacity` int(11) NOT NULL,         
  `maximum_range` int(11) DEFAULT NULL,        
  `rental_price_per_hour` decimal(10,2) NOT NULL, 
  `availability_status` enum('available', 'booked', 'maintenance') DEFAULT 'available', 
  `maintenance_history` text DEFAULT NULL,     
  `features` text DEFAULT NULL,                
  `description` text DEFAULT NULL,             
  `detailed_description` text DEFAULT NULL,    
  `rating` float DEFAULT NULL,                 
  `number_of_reviews` int(11) DEFAULT 0,       
  `image_path` varchar(255) DEFAULT NULL,      
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP, 
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
  PRIMARY KEY (`rental_id`)                    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;         


 -- Insert planes into the Rental_planes table
INSERT INTO `Rental_planes` 
(`manufacturer`, `model`, `year_of_manufacture`, `registration_number`, `maximum_capacity`, 
`maximum_range`, `rental_price_per_hour`, `availability_status`, `maintenance_history`, 
`features`, `detailed_description`, `description`, `rating`, `number_of_reviews`, `image_path`) 
VALUES 
-- Plane 1: Gulfstream G650
('Gulfstream', 'G650', 2017, 'N650GX', 18, 7000, 7000.00, 'available', 'Routine check completed.', 
'High-speed connectivity, spacious cabin, advanced safety features.', 
'A high-speed, long-range business jet with luxurious amenities and advanced safety features.', 
'Luxurious business jet with advanced features.', 4.9, 120, '../Img/Gulfstream.jpg'),

-- Plane 2: Cessna Citation X
('Cessna', 'Citation X', 2015, 'N750CX', 12, 3000, 5000.00, 'available', 'Engines serviced in 2020.', 
'High speed, comfortable cabin, Wi-Fi enabled.', 
'A fast business jet with a sleek design and comfortable cabin.', 
'A fast business jet with a sleek design.', 4.7, 95, '../Img/cessna-citation-x.jpg'),

-- Plane 3: Embraer Phenom 300
('Embraer', 'Phenom 300', 2018, 'N300EX', 10, 3600, 5500.00, 'available', 'Airframe inspection in 2021.', 
'Spacious interior, efficient fuel usage, modern avionics.', 
'An efficient business jet with modern features and a comfortable cabin.', 
'An efficient business jet with modern features.', 4.8, 105, '../Img/embraer-phenom-300-exterior-2.png'),

-- Plane 4: Dassault Falcon 900EX
('Dassault', 'Falcon 900EX', 2016, 'N900EX', 14, 4500, 6000.00, 'available', 'Hydraulics serviced in 2019.', 
'Versatile jet, luxurious interiors, modern amenities.', 
'A mid-size jet with luxurious interiors and versatile performance.', 
'A mid-size jet with luxurious amenities.', 4.6, 85, '../Img/FA900EXeasy-exterior-1200x600.jpg'),

-- Plane 5: Pilatus PC-24
('Pilatus', 'PC-24', 2019, 'N24PC', 10, 3000, 4500.00, 'available', 'Recent avionics upgrade.', 
'Super versatile, comfortable cabin, short takeoff and landing.', 
'A versatile business jet for short to medium-range flights.', 
'A versatile business jet for short to medium-range flights.', 4.5, 90, '../Img/pc-24-super-versatile-jet-scaled-1.jpg'),

-- Plane 6: HondaJet Elite S
('Honda Aircraft', 'HondaJet Elite S', 2020, 'Njet-Elite-S-flight', 6, 1200, 2500.00, 'available', 'Maintenance completed in 2022.', 
'Compact design, efficient, advanced technology.', 
'A compact and efficient business jet for short-range flights.', 
'A compact and efficient business jet for short-range flights.', 4.4, 65, '../Img/HondaJet-Elite-S-flight.avif'),

-- Plane 7: Beechcraft Baron G58
('Beechcraft', 'Baron G58', 2017, 'N58BG', 6, 1000, 1500.00, 'available', 'Airframe inspection in 2021.', 
'Twin-engine, ideal for short trips.', 
'A light twin-engine aircraft suitable for short trips.', 
'A light twin-engine aircraft suitable for short trips.', 4.3, 60, '../Img/baron-G58-charter.jpg'),

-- Plane 8: Cirrus SF50 Vision G2
('Cirrus Aircraft', 'Cirrus SF50 Vision G2', 2018, 'NSF50', 7, 1200, 3500.00, 'available', 'New avionics system installed in 2020.', 
'Personal jet, innovative safety features.', 
'A modern personal jet with innovative safety features.', 
'A modern personal jet with innovative safety features.', 4.6, 70, '../Img/Cirrus-SF50_Vision_G2_flyer-1.jpg'),

-- Plane 9: Dassault Falcon 7X
('Dassault Aviation', 'Falcon 7X', 2014, 'N7X', 12, 6500, 6800.00, 'available', 'Hydraulics and landing gear serviced in 2020.', 
'Long-range business jet, luxurious interiors.', 
'A long-range business jet with luxurious interiors.', 
'A long-range business jet with high capacity.', 4.7, 110, '../Img/2620031.jpg'),

-- Plane 10: Learjet 75
('Learjet', 'Learjet 75', 2016, 'NL75', 9, 2300, 3800.00, 'available', 'Routine maintenance in 2019.', 
'Small business jet, advanced technology.', 
'A small business jet with advanced technology.', 
'A small business jet with advanced technology.', 4.4, 75, '../Img/2621927.jpg');


-- Insert planes into the Rental_planes table
INSERT INTO `Rental_planes` 
(`manufacturer`, `model`, `year_of_manufacture`, `registration_number`, `maximum_capacity`, 
`maximum_range`, `rental_price_per_hour`, `availability_status`, `maintenance_history`, 
`features`, `detailed_description`, `description`, `rating`, `number_of_reviews`, `image_path`) 
VALUES 
-- Plane 11: Gulfstream G280
('Gulfstream', 'G280', 2018, 'NG280', 10, 3600, 6000.00, 'available', 'Annual inspection completed.', 
'Luxurious interiors, advanced avionics, high-speed connectivity.', 
'A versatile business jet with advanced avionics and high-speed connectivity.', 
'A luxurious business jet with advanced avionics.', 4.7, 100, '../Img/374015-dahj_WAS8037a-f8ea1e-large-1608632692.jpg'),

-- Plane 12: Embraer Legacy 450
('Embraer', 'Legacy 450', 2017, 'NL450', 9, 2800, 4500.00, 'available', 'Avionics system updated in 2020.', 
'Spacious cabin, advanced technology, high speed.', 
'A high-speed business jet with a spacious cabin and advanced technology.', 
'A high-speed business jet with a spacious cabin.', 4.6, 85, '../Img/p500-netjets-final-01-M4pN3v__wide__970.jpg'),

-- Plane 13: Bombardier Challenger 350
('Bombardier', 'Challenger 350', 2016, 'NC350', 12, 3600, 5800.00, 'available', 'Engines serviced in 2019.', 
'Spacious cabin, high-performance engines, advanced avionics.', 
'A high-performance business jet with a spacious cabin.', 
'A high-performance business jet with spacious interiors.', 4.8, 110, '../Img/Cirrus-SF50_Vision_G2_flyer-1.jpg'),

-- Plane 14: Beechcraft King Air 350i
('Beechcraft', 'King Air 350i', 2017, 'NK350i', 9, 1800, 2800.00, 'available', 'Airframe inspection completed.', 
'Twin-engine turboprop, versatile, efficient.', 
'A versatile twin-engine turboprop suitable for various missions.', 
'A twin-engine turboprop with versatile performance.', 4.5, 90, '../Img/baron-G58-charter.jpg'),

-- Plane 15: Piper M600
('Piper', 'M600', 2019, 'NM600', 6, 1400, 2200.00, 'available', 'Annual maintenance completed.', 
'Single-engine turboprop, advanced avionics, high efficiency.', 
'A single-engine turboprop with advanced avionics and high efficiency.', 
'A single-engine turboprop with high efficiency.', 4.6, 75, '../Img/2621927.jpg');


-- Table des Emplacements
CREATE TABLE Locations (
  location_id INT PRIMARY KEY AUTO_INCREMENT,
  location_name VARCHAR(255) NOT NULL,
  latitude DECIMAL(10, 8),  -- Latitude
  longitude DECIMAL(11, 8),  -- Longitude
  country VARCHAR(100),  -- Pays
  city VARCHAR(100),  -- Ville
  airport_code VARCHAR(10),  -- Code de l'aéroport (ex : LHR)
  description TEXT  -- Description de l'emplacement
);


-- Mise à jour de la Table des Avions pour inclure la localisation de base
ALTER TABLE Rental_planes
  ADD COLUMN base_location INT,
  ADD FOREIGN KEY (base_location) REFERENCES Locations(location_id);

CREATE TABLE Bookings (
  booking_id INT PRIMARY KEY AUTO_INCREMENT,
  plane_id INT,  -- Clé étrangère liée à Rental_planes
  customer_id INT,  -- Clé étrangère liée à Customers
  booking_date DATETIME,  -- Date de la réservation
  rental_start_date DATETIME,  -- Date de début de location
  rental_end_date DATETIME,  -- Date de fin de location
  departure_location INT,  -- Clé étrangère liée à Locations
  arrival_location INT,  -- Clé étrangère liée à Locations
  total_price DECIMAL(10, 2),  -- Coût total de la réservation
  status ENUM('confirmed', 'pending', 'canceled'),  -- Statut de la réservation
  notes TEXT,
  FOREIGN KEY (plane_id) REFERENCES Rental_planes(rental_id),
  FOREIGN KEY (customer_id) REFERENCES Users(user_id),
  FOREIGN KEY (departure_location) REFERENCES Locations(location_id),
  FOREIGN KEY (arrival_location) REFERENCES Locations(location_id)
);


INSERT INTO Locations (location_name, latitude, longitude, country, city, airport_code, description) 
VALUES 
-- Locations Fixes (pour les avions)
('Paris - Charles de Gaulle', 49.0097, 2.5479, 'France', 'Paris', 'CDG', 'Principal aéroport de Paris.'),
('Londres - Heathrow', 51.4700, -0.4543, 'Royaume-Uni', 'Londres', 'LHR', 'Principal aéroport de Londres.'),
('New York - JFK', 40.6413, -73.7781, 'États-Unis', 'New York', 'JFK', 'Principal aéroport de New York.'),
('Los Angeles - LAX', 33.9416, -118.4085, 'États-Unis', 'Los Angeles', 'LAX', 'Principal aéroport de Los Angeles.'),
('Tokyo - Haneda', 35.5494, 139.7798, 'Japon', 'Tokyo', 'HND', 'Principal aéroport de Tokyo.'),

-- Autres Locations
('San Francisco - SFO', 37.6213, -122.3790, 'États-Unis', 'San Francisco', 'SFO', 'Aéroport international de San Francisco.'),
('Amsterdam - Schiphol', 52.3105, 4.7683, 'Pays-Bas', 'Amsterdam', 'AMS', 'Principal aéroport des Pays-Bas.'),
('Hong Kong - HKG', 22.3080, 113.9185, 'Hong Kong', 'Hong Kong', 'HKG', 'Aéroport international de Hong Kong.'),
('Sydney - Kingsford Smith', -33.8688, 151.2093, 'Australie', 'Sydney', 'SYD', 'Principal aéroport de Sydney.'),
('Dubai - DXB', 25.2532, 55.3657, 'Émirats arabes unis', 'Dubai', 'DXB', 'Aéroport international de Dubai.'),

('Frankfurt - FRA', 50.0379, 8.5622, 'Allemagne', 'Francfort', 'FRA', 'Principal aéroport de Francfort.'),
('Madrid - MAD', 40.4168, -3.7038, 'Espagne', 'Madrid', 'MAD', 'Principal aéroport de Madrid.'),
('Barcelona - BCN', 41.2974, 2.0833, 'Espagne', 'Barcelone', 'BCN', 'Principal aéroport de Barcelone.'),
('Toronto - YYZ', 43.6777, -79.6248, 'Canada', 'Toronto', 'YYZ', 'Aéroport Pearson de Toronto.'),
('Singapore - SIN', 1.3644, 103.9915, 'Singapour', 'Singapour', 'SIN', 'Principal aéroport de Singapour.');


-- Les 5 lieux de départ prédéfinis
SET @location1 = 1;  -- Identifiant du premier lieu
SET @location2 = 2;  -- Identifiant du deuxième lieu
SET @location3 = 3;  -- Identifiant du troisième lieu
SET @location4 = 4;  -- Identifiant du quatrième lieu
SET @location5 = 5;  -- Identifiant du cinquième lieu

-- Mise à jour des avions avec une répartition équitable
-- Les trois premiers avions reçoivent le premier lieu
UPDATE Rental_planes SET location = @location1 WHERE rental_id IN (1, 2, 3);

-- Les trois suivants reçoivent le deuxième lieu
UPDATE Rental_planes SET location = @location2 WHERE rental_id IN (4, 5, 6);

-- Les trois suivants reçoivent le troisième lieu
UPDATE Rental_planes SET location = @location3 WHERE rental_id IN (7, 8, 9);

-- Les trois suivants reçoivent le quatrième lieu
UPDATE Rental_planes SET location = @location4 WHERE rental_id IN (10, 11, 12);

-- Les trois derniers reçoivent le cinquième lieu
UPDATE Rental_planes SET location = @location5 WHERE rental_id IN (13, 14, 15);
