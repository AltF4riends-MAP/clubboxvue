<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Adjust this based on your needs

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clubbox";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// SQL query to fetch data
$sql = "SELECT * FROM cevent";
$result = $conn->query($sql);

if ($result === false) {
    echo json_encode(["error" => "Error executing query: " . $conn->error]);
    $conn->close();
    exit();
}

$events = [];

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $row['image'] = base64_encode($row['image']);
        $events[] = $row;
    }
} else {
    echo json_encode(["error" => "No results found"]);
}

$conn->close();

echo json_encode($events);
?>