<?php
    session_start();

    if (!isset ($_SESSION ['loggedin']) || $_SESSION ['loggedin'] !== true) {
        header ("location: http://localhost/esp-costeo/index.html");
        exit;
    }