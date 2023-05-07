<?php
    session_start();
    require './db_connect/connect.php';
    require 'function.php';
    $email=sanitizeString(mysqli_real_escape_string($conn, $_POST["email"]));
    $password=sanitizeString(mysqli_real_escape_string($conn, $_POST["password"]));


    $stmt = $conn->prepare("SELECT * FROM user WHERE email LIKE ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $message = "Email inesistente";
        echo "<script>if(confirm('$message')){document.location.href='../public/login.html'};</script>";
    }else{
        $hashed_password=md5($password);
        $stmt = $conn->prepare("SELECT * FROM user WHERE email LIKE ? AND password LIKE ?");
        $stmt->bind_param("ss", $email, $hashed_password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['user']=$username;
            if(isset($_SESSION['user'])) {
                $stmt->close();
                echo "<script> window.location = '../public/home.html';</script>";
            }
        } else {
            $message = "Password errata";
            echo "<script>if(confirm('$message')){document.location.href='../public/login.html'};</script>";
        }
    }
?>