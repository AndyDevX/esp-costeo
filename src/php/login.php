<?php
    session_start ();
    include("conexion.php");

    if ($_SERVER ["REQUEST_METHOD"] == "POST") {
        // Sanitize and validate inputs
        $username = $connection -> real_escape_string (trim ($_POST ["username"]));
        $password = $connection -> real_escape_string (trim ($_POST ["password"]));

        // Comprobar existencia del usuario usando una consulta preparada
        $statement = $connection -> prepare ("SELECT id, username, password FROM users WHERE username = ?");
        $statement -> bind_param ("s", $username);
        $statement -> execute ();
        $result_check_user = $statement -> get_result ();

        if ($result_check_user -> num_rows <= 0) {
            echo "<script>alert ('Usuario no encontrado.');history.back();</script>";
        } else {
            // Fetch the user data
            $user_data = $result_check_user -> fetch_assoc ();
            $stored_hash = $user_data ['password'];

            // Verificar la contraseña ingresada contra el hash almacenado
            if (password_verify ($password, $stored_hash)) {
                // Inicio de sesión correcto
                $_SESSION ['loggedin'] = true;
                $_SESSION ['id'] = $user_data ['id'];
                $_SESSION ['username'] = $user_data ['username'];
                header ("location: welcome.php");
                exit;
            } else {
                echo "<script>alert ('La contraseña es incorrecta.');history.back();</script>";
            }
        }
        $statement -> close ();
    }

    $connection -> close ();
