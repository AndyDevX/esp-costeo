<?php
    // Conexión a la BD
    include ("conexion.php");

    // Verificar el envío del formulario
    if ($_SERVER ["REQUEST_METHOD"] == "POST") {
        $username = $connection -> real_escape_string ($_POST ["username"]);
        $email = $connection -> real_escape_string ($_POST ["email"]);
        $password = $connection -> real_escape_string ($_POST ["password"]);
        $password_confirmation = $connection -> real_escape_string ($_POST['confirm_password']);

        // Comparar contraseñas
        if ($password !== $password_confirmation) {
            echo "Las contraseñas no coinciden";
        } else {
            $encrypted_password = password_hash ($password, PASSWORD_DEFAULT);

            // Comprobar disponibilidad de correo
            $sql_check_email = "SELECT * FROM users WHERE email = '$email'";
            $result_check_email = $connection -> query ($sql_check_email);

            if ($result_check_email -> num_rows > 0) {
                echo "Este correo ya está en uso";
            } else {
                // Generar código de seguridad
                $security_code = bin2hex (random_bytes (16)); // Random
                $encrypted_security_code = password_hash ($security_code, PASSWORD_DEFAULT); // Hasheo del código

                // Construcción de la inserción
                $query = "INSERT INTO users (username, email, password, security_code) VALUES ('$username', '$email', '$encrypted_password', '$encrypted_security_code')";

                if ($connection -> query ($query) === TRUE) {
                    echo "Registro exitoso.";
                    /*
                    // Detalles del correo de confirmación
                    $subject = "Verificación de cuenta";
                    $message = "Tu cuenta se registró exitosamente. Este es tu código de seguridad: " . $security_code;
                    $header = "From: correo@grupomapsen.com.mx";

                    if (mail ($email, $subject, $message, $header)) {
                        echo "Registro exitoso. Revisa tu bandeja de entrada para verificar tu cuenta.";
                    } else {
                        echo "Error durante el envío del correo.";
                    }
                    */
                } else {
                    echo "Error: " . $query . "<br>" . $connection -> error;
                }
            }
        }
    }

    $connection -> close ();