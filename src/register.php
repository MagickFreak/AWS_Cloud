<?php
    require '../config/connection.php';
    require 'function.php';

    $firstname=sanitizeString(mysqli_real_escape_string($conn, $_POST["firstname"]));
    $lastname=sanitizeString(mysqli_real_escape_string($conn, $_POST["lastname"]));
    $email=sanitizeString(mysqli_real_escape_string($conn, $_POST["email"]));
    $password=sanitizeString(mysqli_real_escape_string($conn, $_POST["password"]));
    
    if(isset($_POST['check'])){

        $stmt = $conn->prepare("SELECT * FROM user WHERE email LIKE ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "Email già presente";
            echo "<script>if(confirm('$message')){document.location.href='../public/register.html'};</script>";
        }else{
            $hashed_password=md5($password);
                
            $stmt = $conn->prepare("INSERT INTO user (firstname, lastname, email, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $nome, $cognome, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<script> window.location = '../public/login.html';</script>";
            } else {
                $message = "errore";
                echo "<script>if(confirm('$message')){document.location.href='../public/register.html'};</script>";
            }
            $stmt->close();
            $conn->close();
            }
        }
    else{
        $message = "Devi accettare i termini e le condizioni";
        echo "<script>if(confirm('$message')){document.location.href='../public/register.html'};</script>";
    }
