<?php
    // Démarrer la session et inclure la connexion à la base de données
    session_start();
    include 'Base.php';
    global $base;

    // Vérifier si le formulaire a été soumis et récupérer les valeurs
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $plane_id = $_POST['plane_id'];
        $departure_location = $_POST['departure_location'];
        $arrival_location = $_POST['arrival_location'];
        $rental_date = $_POST['rental_date'];
        $rental_time = $_POST['rental_time'];

        // Requête pour obtenir les détails de l'avion
        $stmt = $base->prepare("SELECT * FROM Rental_planes WHERE rental_id = :plane_id");
        $stmt->bindParam(':plane_id', $plane_id);
        $stmt->execute();
        $plane = $stmt->fetch(PDO::FETCH_ASSOC);

        // Requête pour obtenir les détails des locations
        $stmt = $base->prepare("SELECT * FROM Locations WHERE location_id IN (:departure_location, :arrival_location)");
        $stmt->bindParam(':departure_location', $departure_location);
        $stmt->bindParam(':arrival_location', $arrival_location);
        $stmt->execute();
        $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calcul de la distance et du coût
        function haversine_distance($lat1, $lon1, $lat2, $lon2) {
            $earth_radius = 6371;  // Rayon de la Terre en km
            $lat_diff = deg2rad($lat2 - $lat1);
            $lon_diff = deg2rad($lon2 - $lon1);

            $a = sin($lat_diff / 2) * sin($lat_diff / 2) +
                cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                sin($lon_diff / 2) * sin($lon_diff / 2);

            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

            return $earth_radius * $c;
        }

        // Trouver les latitudes et longitudes pour calculer la distance
        $departure_latitude = $locations[0]['latitude'];
        $departure_longitude = $locations[0]['longitude'];
        $arrival_latitude = $locations[1]['latitude'];
        $arrival_longitude = $locations[1]['longitude'];

        $distance = haversine_distance(
            $departure_latitude, $departure_longitude,
            $arrival_latitude, $arrival_longitude
        );

        // Calcul du coût total basé sur le prix pour chaque 1000 km
        $cost_per_1000km = $plane['rental_price_per_hour'];  // Prix par 1000 km
        $total_price = ($distance / 1000) * $cost_per_1000km;

        // Arrondir le coût total à 2 décimales
        $total_price = round($total_price, 2);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="../css/tailwind.css">  <!-- Lien vers votre CSS -->
</head>
<body>
<div class="container mx-auto px-4 py-12">
    <h2 class="font-bold text-3xl">Booking Confirmation</h2>

    <div class="flex flex-col space-y-4">  <!-- Afficher les détails de la réservation -->
        <div class="text-lg">
            <b>Plane Model:</b> <?= $plane['model'] ?>
        </div>
        <div class="text-lg">
            <b>Departure Location:</b> <?= $departure_location ?>
        </div>
        <div class="text-lg">
            <b>Arrival Location:</b> <?= $arrival_location ?>
        </div>
        <div class="text-lg">
            <b>Rental Date:</b> <?= $rental_date ?>
        </div>
        <div class="text-lg">
            <b>Rental Time:</b> <?= $rental_time ?>
        </div>
        <div class="text-lg">
            <b>Total Cost:</b> $<?= round($total_price, 2) ?>
        </div>
    </div>

    <div class="mt-6">
        <button class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600">
            Confirm Booking
        </button>
    </div>
</div>
</body>
</html>
