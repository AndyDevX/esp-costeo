<?php
    include ("../../src/php/conexion.php");
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
            <div class="content">
                
                <p class="h1">Indicadores</p>

                <div class="row">
                    <div class="col">
                        <p class="h3">Unidad Mixtra Infonavit</p>
                        <?php include("modules/umi.php"); ?>
                    </div>
                    <div class="col">
                        <p class="h3">Whatever</p>
                        <table class="custTable">
                            <tr>
                                <th>#</th>
                                <th>Prueba</th>
                                <th>Nothing</th>
                                <th>Whatever</th>
                                <th>Anythinh</th>
                                <th>I dont know</th>
                                <th>Something else</th>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col">col</div>
                    <div class="col">col</div>
                </div>

                <div class="row">
                    <div class="col">col</div>
                    <div class="col">col</div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>