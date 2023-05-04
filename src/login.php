<?php
    session_start();
    require './db_connect/connect.php';
    require 'function.php';

    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=sanitizeString($password);

    $sql= "SELECT email FROM user WHERE $email = 'email'";
    $result=$conn->query($sql);
    if($result->num_rows=0){
        echo "Email  inesistenti";
    }else{
        $password=md5($password);
        $sql="SELECT * FROM user WHERE $email = 'email' AND $password = 'password'";
        $result=$conn->query($sql);
        if($result->num_rows>0){
            session_start();
            $_SESSION['id']=$row['id'];
            header('Location: home.php');
        }
        echo "Login errato";
    }

    $conn->close();
?>