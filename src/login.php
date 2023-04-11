<?php
    session_start();
    require './db_connect/connect.php';

    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql= "SELECT email FROM user WHERE $email = 'email'";
    $result=$conn->query($sql);
    if($result->num_rows=0){
        echo "Email  inesistenti";
    }else{
        $sql="SELECT * FROM user WHERE $email = 'email' AND $password = 'password'";
        $result=$conn->query($sql);
        if($result->num_rows>0){
            session_start();
            $_SESSION['user']=$result->fetch_assoc()['id'];
            header('Location: home.php');
        }
        echo "Login errato";
    }

    $conn->close();
?>