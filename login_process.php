<?php
session_start();
// Handle form submission
if (isset($_POST['login'])) {
    require 'server/connection.php';
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT `user_id`, `name`, `email`, `password`, `role_id` FROM `user` WHERE `email` = ? AND `password` = ?");
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result_customer = $stmt->get_result();

    if ($result_customer->num_rows > 0) {
        $row = $result_customer->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['role_id'] = $row['role_id'];
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
