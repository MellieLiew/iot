<?php
$boxId = "603bbc5eaf6fbf001b07a8e9";
$boxUrl = "https://api.opensensemap.org/boxes/$boxId";
$response = file_get_contents($boxUrl);
$data = json_decode($response, true);

// Extract basic info
$boxName = $data['name'] ?? 'Unknown Location';
$updatedAt = $data['updatedAt'] ?? 'N/A';
$sensors = $data['sensors'] ?? [];

$country = 'Unknown Country';
$latitude = '';
$longitude = '';
$locationText = 'Unavailable';

// ✅ Use 'loc' instead of 'currentLocation'
if (isset($data['loc'][0]['geometry']['coordinates'])) {
    $coordinates = $data['loc'][0]['geometry']['coordinates'];
    $longitude = $coordinates[0];
    $latitude = $coordinates[1];
    $locationText = "$latitude, $longitude";

    // Optional: Get country using reverse geocoding
    $geoUrl = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=$latitude&lon=$longitude";
    $context = stream_context_create(["http" => ["header" => "User-Agent: PHP"]]);
    $geoResponse = @file_get_contents($geoUrl, false, $context);
    if ($geoResponse !== false) {
        $geoData = json_decode($geoResponse, true);
        $country = $geoData['address']['country'] ?? 'Unknown Country';
    }
}

// Graph setup using the first sensor
$graphSensor = $sensors[0] ?? null;
$graphSensorId = $graphSensor['_id'] ?? null;
$measurements = [];

if ($graphSensorId) {
    $measureUrl = "https://api.opensensemap.org/boxes/$boxId/data/$graphSensorId?format=json&download=false";
    $measureRaw = @file_get_contents($measureUrl);
    $measurements = $measureRaw ? json_decode($measureRaw, true) : [];
}
?>
