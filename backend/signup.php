<?php
session_start();
include 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

$response = ["success" => false, "message" => "Something went wrong."];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    file_put_contents('debug.txt', print_r($_POST, true));  // For debugging

    $register_type = trim($_POST['register_type'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["message"] = "Invalid email format.";
        echo json_encode($response);
        exit;
    }
    if ($register_type === "HOSPITAL") {
        $licence_id = trim($_POST['Lincence_number'] ?? '');
        $checkStmt = $conn->prepare("SELECT hospital_id FROM hospital WHERE hospital_licence_id = ?");
        $checkStmt->bind_param("s", $licence_id);
    } else {
        $checkStmt = $conn->prepare("SELECT user_id FROM users WHERE gmail = ?");
        $checkStmt->bind_param("s", $email);
    }

    if (!$checkStmt) {
        $response["message"] = "Database error during check.";
        echo json_encode($response);
        exit;
    }

    $checkStmt->execute();
    $checkStmt->store_result();
    if ($checkStmt->num_rows > 0) {
        $response["message"] = "Email or Licence number already registered.";
        echo json_encode($response);
        exit;
    }
    $checkStmt->close();

    if ($register_type === "HOSPITAL") {
        $hospital_name = $username;
        $licence_id = trim($_POST['Lincence_number'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $hospital_type = "PVT";
        $website = trim($_POST['website'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $stmt = $conn->prepare("INSERT INTO hospital (hospital_name, address, hospital_type, hospital_licence_id, website_link) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            $response["message"] = "Database error during hospital insert.";
            echo json_encode($response);
            exit;
        }
        $stmt->bind_param("ssssss", $hospital_name, $address, $hospital_type, $licence_id, $website,$password);
    } else {
        $contact = trim($_POST['contact'] ?? '');
        $user_address = trim($_POST['user_address'] ?? '');
        $dob = trim($_POST['dob'] ?? '');
        $blood_G = trim($_POST['blood_G'] ?? '');
        $active = 1;
        $verify = 0;
        $card_id = intval($_POST['card_id'] ?? 0);

        $stmt = $conn->prepare("INSERT INTO users (full_name, gmail, password, contact, addresas, dob, blood_G, active, verify, card_id) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            $response["message"] = "Database error during user insert.";
            echo json_encode($response);
            exit;
        }

        $stmt->bind_param("sssisssiii", $username, $email, $password, $contact, $user_address, $dob, $blood_G, $active, $verify, $card_id);
    }

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Sign-up successful!";
    } else {
        error_log("SQL Error: " . $stmt->error);
        $response["message"] = "Something went wrong while saving your data.";
    }

    $stmt->close();
    $conn->close();
} else {
    $response["message"] = "Invalid request.";
}

echo json_encode($response);
