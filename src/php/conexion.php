<?php
    $host = "localhost:3306";
    $user = "esp_db_admin";
    $pass = "KmRqxGUtHVLs";
    $db = "calculadora_inpc";

    $connection = new mysqli ($host, $user, $pass, $db);
    
    if ($connection -> connect_error) {
        die ("Conexión fallida: " . $connection -> connect_error);
    }