<?php
    include ("../../src/php/conexion.php");
    include ("modules/umi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Estilos propios -->
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="bg-image d-flex justify-content-center align-items-center" id="menu-tools">
        <div class="custom-container text-center">

        <button class="btn btn-primary" id="top-back" onclick="window.location.href='../menu.php';">Volver</button>

            <div class="content">
                
                <p class="h1">Indicadores</p>
                <div class="row">

                    <div class="section">
                        <p class="h3">Unidad Mixtra Infonavit</p>
                        <!-- TABLA DE UMI -->
                        <table id="UMItable" class="custTable">
                            <thead>
                                <tr>
                                    <th class="columna1">#</th>
                                    <th class="columna2">Año</th>
                                    <th class="columna3">UMI</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php getData($connection) ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        Hola
                    </div>

                </div>

                

            </div>
        </div>
    </div>

</body>

</html>