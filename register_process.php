<?php
session_start();
require 'server/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        die("Passwords do not match.");
    }

    // Hash password for security
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute registration query
    $stmt = $conn->prepare("INSERT INTO `user` (`name`, `email`, `password`,`role_id`) VALUES (?, ?, ?, 2)");
    $stmt->bind_param("sss", $name, $email, $hashedPassword);

    if ($stmt->execute()) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        header("Location: index.php");
        exit();
    } else {
        die("Registration failed. Please try again.");
    }

    $stmt->close();
    $conn->close();
}
?>
