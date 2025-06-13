<?php
session_start();
include 'db.php';
if (!$conn) {
    echo json_encode(["success" => false, "message" => "Server is not responding."]);
    exit;
}
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role = trim($_POST['register_type'] ?? '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Invalid email format.';
        echo json_encode($response);
        exit;
    }
    if ($role === 'User') {
        $stmt = $conn->prepare("SELECT * FROM users WHERE gmail = ?");
    } elseif ($role === 'HOSPITAL') {
        $stmt = $conn->prepare("SELECT * FROM hospital WHERE hospital_licence_id = ?");
    } else {
        $response['message'] = 'Invalid role selected.';
        echo json_encode($response);
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $response['message'] = 'No account found for the given credentials.';
        echo json_encode($response);
        exit;
    }

    $userData = $result->fetch_assoc();
    if ($password== $userData['password']) {
        $_SESSION['user'] = $userData;
        $_SESSION['role'] = $role;
        $response['success'] = true;
        $response['message'] = 'Login successful!';
        $response['redirect'] = ($role === 'User') ? 'http://localhost/Lifelink/' : 'hospital_dashboard.php';
    } else {
        $response['message'] = 'Incorrect password.';
    }
}

echo json_encode($response);
exit;
?>