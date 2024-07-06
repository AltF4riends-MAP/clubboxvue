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

// Get data from POST request
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$image = isset($_POST['image']) ? base64_decode($_POST['image']) : null;

// Prepare and bind
$stmt = $conn->prepare("UPDATE club SET name=?, description=?, image=? WHERE id=?");
$stmt->bind_param("sssi", $name, $description, $image, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Error updating record: " . $conn->error]);
}

$stmt->close();
$conn->close();
?>