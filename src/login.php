<?php
    require '../config/connection.php';
    require 'function.php';
    session_start();
    $email=sanitizeString(mysqli_real_escape_string($conn, $_POST["email"]));
    $password =sanitizeString(mysqli_real_escape_string($conn, $_POST["password"]));
    
    $sql = "SELECT id, email FROM user
    WHERE email LIKE ? AND password=md5($password);";
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("s", $email);
    $query_response = [];
    $stmt->bind_result($query_response['id'], $query_response['email']);
    $stmt->execute();
    
    if ($stmt->fetch()){
      $_SESSION['user_id'] = $query_response['id'];
      $_SESSION['email'] = $query_response['email'];
      $response['message'] = 'Login Riuscito';
      header('Location: ../public/home.html');
    }else{
      http_response_code(400);
      $response['message'] = 'Login Fallito';
      header('Location: ../public/login.html');
    }
    $stmt->close();
    
    echo json_encode($response);
?>