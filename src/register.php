<?php
    require '../config/connection.php';
    require 'function.php';

    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $password=sanitizeString($password);

    $sql="SELECT * FROM user WHERE email='$email'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        echo "L'utente con questa email: ".$email." è già registrato";
    }else{
        $password=md5($password);
        $sql="INSERT INTO user(firstname,lastname,email,password) VALUES('$firstname','$lastname','$email','$password')";
        if($conn->query($sql)===TRUE){
            header('Location:login.html');
        }else{
            echo $conn->error;
    }
     
}
$conn->close();
?>
    }
