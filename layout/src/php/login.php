<?php
    session_start ();
    include("conexion.php");

    if ($_SERVER ["REQUEST_METHOD"] == "POST") {
        // Sanitize and validate inputs
        $email = $connection -> real_escape_string (trim ($_POST ["email"]));
        $password = $connection -> real_escape_string (trim ($_POST ["password"]));

        // Comprobar existencia del usuario usando una consulta preparada
        $statement = $connection -> prepare ("SELECT id, username, password FROM users WHERE email = ?");
        $statement -> bind_param ("s", $email);
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
                $_SESSION ['email'] = $user_data ['email'];
                header ("location: ../../public/menu.php");
                exit;
            } else {
                echo "<script>alert ('La contraseña es incorrecta.');history.back();</script>";
            }
        }
        $statement -> close ();
    }

    $connection -> close ();
