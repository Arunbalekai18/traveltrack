<?php
include('db_connect.php');
?>
<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Submitted Trips</title>
<style>body{font-family:Arial;padding:10px;max-width:900px;margin:auto} table{width:100%;border-collapse:collapse} th,td{padding:8px;border:1px solid #ddd;text-align:left} th{background:#f1f1f1}</style>
</head><body>
<h2>Submitted Trips</h2>
<p><a href="index.html">Back to Capture</a></p>
<table>
  <tr>
    <th>ID</th><th>Trip No</th><th>Origin</th><th>Destination</th><th>Start</th><th>End</th><th>Mode</th><th>Distance (km)</th><th>Purpose</th><th>Companions</th><th>Cost</th>
  </tr>
<?php
$sql = "SELECT trip_id, trip_number, origin_lat, origin_lon, destination_lat, destination_lon, start_time, end_time, mode_used, travel_distance, trip_purpose, companions, cost FROM trips ORDER BY created_at DESC LIMIT 500";
$res = $conn->query($sql);
if ($res && $res->num_rows) {
    while($row = $res->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row['trip_id']."</td>";
        echo "<td>".$row['trip_number']."</td>";
        echo "<td>".($row['origin_lat']? $row['origin_lat'].' , '.$row['origin_lon'] : 'N/A')."</td>";
        echo "<td>".($row['destination_lat']? $row['destination_lat'].' , '.$row['destination_lon'] : 'N/A')."</td>";
        echo "<td>".$row['start_time']."</td>";
        echo "<td>".$row['end_time']."</td>";
        echo "<td>".htmlspecialchars($row['mode_used'])."</td>";
        echo "<td>".$row['travel_distance']."</td>";
        echo "<td>".htmlspecialchars($row['trip_purpose'])."</td>";
        echo "<td>".$row['companions']."</td>";
        echo "<td>".$row['cost']."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='11'>No trips found</td></tr>";
}
$conn->close();
?>
</table>
</body></html>
