<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $host = "localhost:3306";
    $username = "db_accounts";
    $password = "XwOyCqX72LB*";
    $database = "accounts";

    try {
        // Create connection
        $conn = new mysqli($host, $username, $password, $database);
    
        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";
    } catch (Exception $e) {
        // Log the error message and show a user-friendly message
        error_log($e->getMessage());
        die("Sorry, there was an issue connecting to the database. Please try again later.");
    }