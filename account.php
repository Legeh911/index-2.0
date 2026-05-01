<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email    = isset($_POST['email'])    ? trim($_POST['email'])    : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password']       : '';

    if (empty($email) || empty($username) || empty($password)) {
        echo "All fields are required.";
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }
    if (strlen($username) < 3) {
        echo "Username must be at least 3 characters.";
        exit();
    }
    if (strlen($password) < 6) {
        echo "Password must be at least 6 characters.";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "Email or username already exists.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $username, $hashed_password);
        if ($stmt->execute()) {
            echo "OK";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    $check->close();
    $conn->close();
}
?>
