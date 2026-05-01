<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = isset($_POST['user']) ? trim($_POST['user']) : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

    if (empty($user) || empty($pass)) {
        echo "Please fill in all fields.";
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $user, $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['just_logged_in'] = true; 
            
            echo "OK:" . $row['username'];
        } else {
            echo "Wrong password.";
        }
    } else {
        echo "No account found.";
    }
    $stmt->close();
    $conn->close();
}
?>