<?php
// save_trip.php
include('db_connect.php');

// helper to get POST safely
function get($key) {
    return isset($_POST[$key]) ? $_POST[$key] : null;
}

$trip_number = get('trip_number');
$origin_lat = get('origin_lat');
$origin_lon = get('origin_lon');
$start_time = get('start_time'); // expects 'YYYY-MM-DD hh:mm:ss' or empty
$destination_lat = get('destination_lat');
$destination_lon = get('destination_lon');
$end_time = get('end_time');
$mode_used = get('mode_used');
$travel_distance = get('travel_distance');
$trip_purpose = get('trip_purpose');
$companions = get('companions');
$frequency = get('frequency');
$cost = get('cost');

$sql = "INSERT INTO trips (trip_number, origin_lat, origin_lon, start_time, destination_lat, destination_lon, end_time, mode_used, travel_distance, trip_purpose, companions, frequency, cost)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param(
    "idssdsssdsiis",
    $trip_number,
    $origin_lat,
    $origin_lon,
    $start_time,
    $destination_lat,
    $destination_lon,
    $end_time,
    $mode_used,
    $travel_distance,
    $trip_purpose,
    $companions,
    $frequency,
    $cost
);

// Note: types used above: i=integer, d=double, s=string
// To ensure correct types, cast / sanitize
$trip_number = $trip_number !== '' ? intval($trip_number) : null;
$origin_lat = $origin_lat !== '' ? floatval($origin_lat) : null;
$origin_lon = $origin_lon !== '' ? floatval($origin_lon) : null;
$destination_lat = $destination_lat !== '' ? floatval($destination_lat) : null;
$destination_lon = $destination_lon !== '' ? floatval($destination_lon) : null;
$travel_distance = $travel_distance !== '' ? floatval($travel_distance) : 0.0;
$companions = $companions !== '' ? intval($companions) : 0;
$cost = $cost !== '' ? floatval($cost) : 0.0;

if ($stmt->execute()) {
    echo "Trip recorded successfully (ID: " . $stmt->insert_id . ").";
} else {
    echo "Error saving trip: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
