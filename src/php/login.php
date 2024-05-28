<?php 
    include("conexion.php");

    if ($_SERVER ["REQUEST_METHOD"] == "POST") {
        // Sanitize and validate inputs
        $username = $connection -> real_escape_string (trim ($_POST ["username"]));
        $password = $connection -> real_escape_string (trim ($_POST ["password"]));

        // Comprobar existencia del usuario usando una consulta preparada
        $stmt = $connection -> prepare ("SELECT * FROM users WHERE username = ?");
        $stmt -> bind_param ("s", $username);
        $stmt -> execute ();
        $result_check_user = $stmt -> get_result ();

        if ($result_check_user -> num_rows <= 0) {
            echo "Usuario no encontrado";
        } else {
            // Fetch the user data
            $user_data = $result_check_user -> fetch_assoc ();
            $stored_hash = $user_data ['password'];

            // Verificar la contraseña ingresada contra el hash almacenado
            if (password_verify ($password, $stored_hash)) {
                echo "Inicio de sesión correcto";
            } else {
                echo "La contraseña es incorrecta";
            }
        }
        $stmt -> close ();
    }

    $connection -> close ();
