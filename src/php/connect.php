<?php
    $host = "localhost:3306";
    $username = "estudiante_umma";
    $password = "";
    $database = "calculadora_inpc";

    $connection = new mysqli ($host, $username, $password, $database);

    if ($connection -> connect_error) {
        die ("Conexión fallida: ".$connection -> connect_error);
    }