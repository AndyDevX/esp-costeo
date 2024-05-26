<?php
require 'connect.php';

$token = $_GET['token'];

$sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $update_query = "UPDATE users SET is_verified=1, token=NULL WHERE id=" . $user['id'];
    if ($conn->query($update_query) === TRUE) {
        echo "Correo verificado exitosamente.";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Token invalido.";
}

$conn->close();