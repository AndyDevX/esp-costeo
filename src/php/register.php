<?php
    require 'connect.php';
    require 'email.php';
    require 'vendor/autoload.php';
    
    $username = $_POST['usernmae'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(50));
    
    $sql = "INSERT INTO users (usernmae, email, password, token) VALUES ('$username', '$email', '$password', '$token')";
    
    if ($conn->query($sql) === TRUE) {
        sendVerificationEmail($email, $token);
        echo "Registro exitoso. Por favor revisa tu bandeja de entrada para verificar la cuenta.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
    