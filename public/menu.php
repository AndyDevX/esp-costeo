<?php
    //include ("../src/php/session_check.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú herramientas</title>
    <link rel="shortcut icon" href="../assets/img/esp-logo.jpeg" type="image/x-icon">
    <!-- Estilos propios -->
    <link rel="stylesheet" href="../assets/css/menu.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="bg-image d-flex justify-content-center align-items-center" id="menu-tools">
        <div class="custom-container text-center" id="form-container">
            <img src="../assets/img/esp-banner.jpeg" alt="Mayasoft">
            <p class="h1 mb-3" id="form-title">Herramientas</p>

            <div class="card-list-container">
                <div class="box">
                    <div class="img-container">
                        <a href="#">
                            <img src="../assets/img/buttons/square/1.png" alt="...">
                        </a>
                    </div>
                    <p>Calculadora fiscal</p>
                </div>

                <div class="box">
                    <div class="img-container">
                        <a href="binario/index.php">
                            <img src="../assets/img/buttons/square/2.png" alt="...">
                        </a>
                    </div>
                    <p>Conversor binario</p>
                </div>
                
                <div class="box">
                    <div class="img-container">
                        <a href="finanzas/calc_financiera.php">
                            <img src="../assets/img/buttons/square/3.png" alt="...">
                        </a>
                    </div>
                    <p>Calculadora finanzas</p>
                </div>

                <div class="box">
                    <div class="img-container">
                        <a href="#">
                            <img src="../assets/img/buttons/square/4.png" alt="...">
                        </a>
                    </div>
                    <p>Calculadora laboral</p>
                </div>

                <div class="box">
                    <div class="img-container">
                        <a href="indicadores/indicadores.php">
                            <img src="../assets/img/buttons/square/#" alt="...">
                        </a>
                    </div>
                    <p>Indicadores</p>
                </div>
                
            </div>

            <button onclick="window.location.href = '../index.html'" class="btn btn-secondary">Volver</button>

        </div>

    </div>

</body>

</html>