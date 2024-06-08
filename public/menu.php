<?php
    include ("../src/php/session_check.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú herramientas</title>
    <!-- Estilos propios -->
    <link rel="stylesheet" href="../assets/css/menu.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="bg-image d-flex justify-content-center align-items-center" id="menu-tools">
        <div class="custom-container text-center" id="form-container">
            <img src="../assets/img/microsoft.png" alt="Mayasoft">
            <p class="h1 mb-3" id="form-title">Herramientas</p>

            <div class="card-list-container">
                <div class="box">
                    <div class="box-title"></div>
                    <div class="img-container">
                        <a href="#">
                            <img src="../assets/img/buttons/square/1.png" alt="...">
                        </a>
                    </div>
                    <p>Calculadora fiscal</p>
                </div>

                <div class="box">
                    <div class="box-title"></div>
                    <div class="img-container">
                        <a href="binario/index.php">
                            <img src="../assets/img/buttons/square/2.png" alt="...">
                        </a>
                    </div>
                    <p>Conversor binario</p>
                </div>
                
                <div class="box">
                    <div class="box-title"></div>
                    <div class="img-container">
                        <a href="finanzas/calc_financiera.html">
                            <img src="../assets/img/buttons/square/3.png" alt="...">
                        </a>
                    </div>
                    <p>Calculadora finanzas</p>
                </div>

                <div class="box">
                    <div class="box-title">
                    </div>
                    <div class="img-container">
                        <a href="#">
                            <img src="../assets/img/buttons/square/4.png" alt="...">
                        </a>
                    </div>
                    <p>Calculadora laboral</p>
                </div>
                
            </div>

            <button onclick="window.location.href = '../index.html'" class="btn btn-secondary">Volver</button>

        </div>

    </div>

</body>

</html>