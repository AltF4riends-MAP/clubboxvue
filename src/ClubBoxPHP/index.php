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

// Connect to the database
$conn = getDbConnection();

// Parse the request URL to determine the resource and ID
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

echo "Before Post Club";

// clubEvent Stuff
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $resource == 'clubevent') {

    echo "In Post Club";

    $input = get_input_data();
    // $uploadEventImage = file_get_contents($_FILES['$eventImage']);

    if (!$input) {
        echo json_encode(["message" => "Invalid input"]);
        http_response_code(400);
        exit;
    }

    $eventName = $conn->real_escape_string($input['eventName']);
    $eventDesc = $conn->real_escape_string($input['eventDesc']);
    $eventDate = $conn->real_escape_string($input['eventDate']);
    $eventType = $conn->real_escape_string($input['eventType']);
    $eventShortDesc = $conn->real_escape_string($input['eventShortDesc']);
    $eventTime = $conn->real_escape_string($input['eventTime']);
    $eventPrice = $conn->real_escape_string($input['eventPrice']);


    $sql = "INSERT INTO clubevent (name, description, date, type, shortDescription, time, price, clubId) 
    VALUES ('$eventName', '$eventDesc', '$eventDate', '$eventType', '$eventShortDesc', '$eventTime', '$eventPrice', 1)";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "User created successfully", "id" => $conn->insert_id]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
        http_response_code(500);
    }
    exit;
}

//********************************************************************************************* */
//********************************************************************************************* */
//club stuff
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $resource == 'club') {
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
    exit;

}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $resource == 'club') {
    $sql = "SELECT id, name, description, image FROM club";
    $result = $conn->query($sql);

    if ($result === false) {
        echo json_encode(["error" => "Error executing query: " . $conn->error]);
        $conn->close();
        exit();
    }

    $clubs = [];

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $row['image'] = base64_encode($row['image']);
            $clubs[] = $row;
        }
    } else {
        echo json_encode(["error" => "No results found"]);
    }

    echo json_encode($clubs);
    exit;
}



// if ($_SERVER['REQUEST_METHOD'] == 'POST' && $resource == 'clubevent') {
//     $input = get_input_data();
    
//     // Check if the file was uploaded without errors
//     if (isset($_FILES['eventImage']) && $_FILES['eventImage']['error'] == 0) {
//         $fileTmpPath = $_FILES['eventImage']['tmp_name'];
//         $fileName = $_FILES['eventImage']['name'];
//         $fileSize = $_FILES['eventImage']['size'];
//         $fileType = $_FILES['eventImage']['type'];
//         $fileNameCmps = explode(".", $fileName);
//         $fileExtension = strtolower(end($fileNameCmps));

//         // Sanitize file name
//         $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

//         // Check if the file has an allowed extension
//         $allowedfileExtensions = array('jpg', 'gif', 'png', 'webp');
//         if (in_array($fileExtension, $allowedfileExtensions)) {
//             // Directory where uploaded files will be saved
//             $uploadFileDir = './uploaded_files/';
//             $dest_path = $uploadFileDir . $newFileName;

//             if (move_uploaded_file($fileTmpPath, $dest_path)) {
//                 $uploadEventImage = $dest_path;
//             } else {
//                 echo json_encode(["message" => "There was an error moving the uploaded file."]);
//                 http_response_code(500);
//                 exit;
//             }
//         } else {
//             echo json_encode(["message" => "Upload failed. Allowed file types: " . implode(',', $allowedfileExtensions)]);
//             http_response_code(400);
//             exit;
//         }
//     } else {
//         echo json_encode(["message" => "No file uploaded or there was an upload error."]);
//         http_response_code(400);
//         exit;
//     }

//     $eventName = $conn->real_escape_string($input['eventName']);
//     $eventDesc = $conn->real_escape_string($input['eventDesc']);
//     $eventDate = $conn->real_escape_string($input['eventDate']);
//     $eventType = $conn->real_escape_string($input['eventType']);
//     $eventShortDesc = $conn->real_escape_string($input['eventShortDesc']);
//     $eventTime = $conn->real_escape_string($input['eventTime']);
//     $eventPrice = $conn->real_escape_string($input['eventPrice']);

//     $sql = "INSERT INTO clubevent (name, description, date, type, shortDescription, time, price, image) 
//             VALUES ('$eventName', '$eventDesc', '$eventDate', '$eventType', '$eventShortDesc', '$eventTime', '$eventPrice', '$uploadEventImage')";

//     if ($conn->query($sql) === TRUE) {
//         echo json_encode(["message" => "Event created successfully", "id" => $conn->insert_id]);
//     } else {
//         echo json_encode(["message" => "Error: " . $conn->error]);
//         http_response_code(500);
//     }
//     exit;
// }

echo json_encode(["message" => "Invalid request method"]);
http_response_code(405);
$conn->close();

