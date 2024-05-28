<?php
    // Conexión a la BD
    include ("conexion.php");

    // Verificar el envío del formulario
    if ($_SERVER ["REQUEST_METHOD"] == "POST") {
        $username = $connection -> real_escape_string (trim ($_POST ["username"]));
        $email = $connection -> real_escape_string (trim ($_POST ["email"]));
        $password = $connection -> real_escape_string (trim ($_POST ["password"]));
        $password_confirmation = $connection -> real_escape_string (trim ($_POST['confirm_password']));

        // Comparar contraseñas
        if ($password !== $password_confirmation) {
            echo "<script>alert ('¡Las contraseñas no coinciden!');history.back();</script>";
        } else {
            $encrypted_password = password_hash ($password, PASSWORD_DEFAULT);

            // Comprobar disponibilidad de correo
            $statement = $connection -> prepare ("SELECT * FROM users WHERE email = ?");
            $statement -> bind_param ("s", $email);
            $statement -> execute ();
            $result_check_email = $statement -> get_result ();

            if ($result_check_email -> num_rows > 0) {
                echo "<script>alert ('¡Este correo ya está en uso!');history.back();</script>";
            } else {
                // Generar código de seguridad
                $security_code = bin2hex (random_bytes (16)); // Random
                $encrypted_security_code = password_hash ($security_code, PASSWORD_DEFAULT); // Hasheo del código

                // Construcción de la inserción
                $statement = $connection -> prepare ("INSERT INTO users (username, email, password, security_code) VALUES (?, ?, ?, ?)");
                $statement -> bind_param ("ssss", $username, $email, $encrypted_password, $encrypted_security_code);

                if ($statement -> execute ()) {
                    echo "<script>alert ('Registro exitoso.');history.back();</script>";
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
                    echo "<script>alert ('Error durante el registro. Por favor, inténtalo de nuevo.');history.back();</script>";
                }
            }
            $statement -> close ();
        }
    }

    $connection -> close ();