<?php
    require 'server/connection.php';
    mysqli_set_charset($conn, 'UTF8');

    // Grant Role
    if (isset($_POST['update_role']) && isset($_POST['checkbox'])) {
        $chkarr = $_POST['checkbox'];
        foreach ($chkarr as $user_id) { 
            $sql = "UPDATE `user` SET `role_id`='3' WHERE `user_id`=$user_id";
            $conn->query($sql);
        }
        header("location: user.php");
        echo "Roles have been granted.";
    }

    // Revoke Role
    if (isset($_POST['revoke_role']) && isset($_POST['checkbox'])) {
        $chkarr = $_POST['checkbox'];
        foreach ($chkarr as $user_id) { 
            $sql = "UPDATE `user` SET `role_id`='2' WHERE `user_id`=$user_id";
            $conn->query($sql);
        }
        header("location: user.php");
        echo "Roles have been revoked.";
    }

    // Delete Account
    if (isset($_POST['delete_acc']) && isset($_POST['checkbox'])) {
        $chkarr = $_POST['checkbox'];
        foreach ($chkarr as $user_id) { 
            $sql = "DELETE FROM `user` WHERE `user_id`='$user_id'";
            $conn->query($sql);
        }
        header("location: user.php");
        echo "Accounts have been deleted.";
    }
?>