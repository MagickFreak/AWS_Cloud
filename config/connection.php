<?php
    $ip="localhost";
    $username="user";
    $password="";
    $database="aws_cloud";

    //connessione
    $conn=new mysqli($ip,$username,$password,$database);
    if($conn->connect_error){
        die("Connessione non riuscita: ".$conn->connect_error);
    }
?>