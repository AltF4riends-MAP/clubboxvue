<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');


if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}
require_once './config.php';


function get_input_data()
{
    return json_decode(file_get_contents('php://input'), true);
}

$conn = getDbConnection();

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
$path = trim($request_uri[0], '/');
$segments = explode('/', $path);
$resource = $segments[1] ?? null;
$id = $segments[2] ?? null;

//********************************************************************************************* */
// Fetch all students
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $resource == 'student' && !$id) {
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);
    $students = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }
    echo json_encode($students);
    exit;
}

// Fetch a specific student
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $resource == 'student' && $id) {
    $id = intval($id);
    $sql = "SELECT * FROM student WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["message" => "Student not found"]);
    }
    exit;
}

//Update User
if ($_SERVER['REQUEST_METHOD'] == 'PUT' && $resource == 'student' && $id) {
    $id = intval($id);
    $input = get_input_data();
    if (!$input) {
        echo json_encode(["message" => "Invalid input"]);
        http_response_code(400);
        exit;
    }

    $firstName = $conn->real_escape_string($input['firstName']);
    $lastName = $conn->real_escape_string($input['lastName']);
    $matricNo = $conn->real_escape_string($input['matricNo']);
    $yearCourse = $conn->real_escape_string($input['yearCourse']);
    $phoneNumber = $conn->real_escape_string($input['phoneNumber']);
    $address = $conn->real_escape_string($input['address']);
    $password = $conn->real_escape_string($input['password']);

    $sql = "UPDATE student SET firstName = '$firstName', lastName = '$lastName', matricNo ='$matricNo', yearCourse = '$yearCourse', phoneNumber = '$phoneNumber', address = '$address', password = '$password' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "User Updated successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
        http_response_code(500);
    }
    exit;
}


// POST for login and register
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $resource == 'student') {
    $input = get_input_data();

    // Login
    if (isset($input['utmEmail']) && isset($input['password']) && !isset($input['firstName'])) {
        $utmEmail = $conn->real_escape_string($input['utmEmail']);
        $password = $conn->real_escape_string($input['password']);

        $sql = "SELECT * FROM student WHERE utmEmail = '$utmEmail' AND password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo json_encode($result->fetch_assoc());
        } else {
            echo json_encode(["message" => "Invalid Email or Password!"]);
            http_response_code(404);
        }
        exit;
    } else {
        //Register
        if (!$input) {
            echo json_encode(["message" => "Invalid input"]);
            http_response_code(400);
            exit;
        }

        $firstName = $conn->real_escape_string($input['firstName']);
        $lastName = $conn->real_escape_string($input['lastName']);
        $matricNo = $conn->real_escape_string($input['matricNo']);
        $yearCourse = $conn->real_escape_string($input['yearCourse']);
        $phoneNumber = $conn->real_escape_string($input['phoneNumber']);
        $address = $conn->real_escape_string($input['address']);
        $utmEmail = $conn->real_escape_string($input['utmEmail']);
        $password = $conn->real_escape_string($input['password']);
        $accessLevel = 0;

        $sql = "INSERT INTO student (firstName, lastName, matricNo, yearCourse, phoneNumber, address, utmEmail, password, accessLevel) VALUES ('$firstName', '$lastName', '$matricNo', '$yearCourse', '$phoneNumber','$address', '$utmEmail', '$password', '$accessLevel')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["message" => "User created successfully", "id" => $conn->insert_id]);
        } else {
            echo json_encode(["message" => "Error: " . $conn->error]);
            http_response_code(500);
        }
        exit;
    }
}

//********************************************************************************************* */
//********************************************************************************************* */

//This is for Eventssssss
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $resource == 'clubevent' && !$id) {
    $sql = "SELECT * FROM clubevent";
    $result = $conn->query($sql);
    if ($result === FALSE) {
        error_log("SQL Error: " . $conn->error);
    } else {
        error_log("SQL executed successfully.");
    }
    $events = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['image']) {
                $row['image'] = base64_encode($row['image']);
            }
            $events[] = $row;
        }
    }
    echo json_encode($events);
    exit;
}

echo json_encode(["message" => "Invalid request method"]);
http_response_code(405);
$conn->close();

