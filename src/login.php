<?php
    session_start();
    require './db_connect/connect.php';
    require 'function.php';
    $email=sanitizeString(mysqli_real_escape_string($conn, $_POST["email"]));
    $password =sanitizeString(mysqli_real_escape_string($conn, $_POST["password"]));
    
    $sql = "SELECT id, email FROM user
    WHERE email LIKE ? AND password=md5($password);";
    
    $statement = $conn->prepare($sql);
    
    $statement->bind_param("sss", $email,$password,$email);
    $query_response = [];
    $statement->bind_result($query_response['id'], $query_response['email']);
    $statement->execute();
    
    if ($statement->fetch()){
      $_SESSION['user_id'] = $query_response['id'];
      $_SESSION['email'] = $query_response['email'];
      $response['message'] = 'Login Riuscito';
      header('Location: home.html');
    }else{
      http_response_code(400);
      $response['message'] = 'Login Fallito';
      header('Location: login.html');
    }
    $statement->close();
    
    echo json_encode($response);
    ?>
?>