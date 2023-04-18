<?php
    $hostname="54.159.4.49";
    $username="user";
    $password="password";
    $database="AWS_Cloud";
    $port="3306";

    //connessione
    $conn=new mysqli($hostname,$username,$password,$database,$port);
    if($conn->connect_error){
        die("Connessione non riuscita: ".$conn->connect_error);
    }
?>