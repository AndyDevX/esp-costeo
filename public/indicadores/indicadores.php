<?php
    include ("../../src/php/conexion.php");
    include ("modules/getData.php");
?>
<!DOCTYPE html>
<html lang="es">
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
                        <p class="h3">Unidad Mixta Infonavit</p>
                        <!-- TABLA DE UMI -->
                        <table id="UMItable" class="custTable">
                            <thead>
                                <tr>
                                    <th>Año</th>
                                    <th>UMI</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    getUMI($connection);
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <p class="h3 mt-3">Unidad de Medida y Actualización</p>
                        <!-- TABLA DE UMA -->
                        <table id="UMAtable" class="custTable">
                            <thead>
                                <tr>
                                    <th>Año</th>
                                    <th>Diario</th>
                                    <th>Mensual</th>
                                    <th>Anual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    getUMA($connection);
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="section">
                        <p class="h3 mt-3">Retención de interés</p>
                        <!-- TABLA DE RETENCIÓN INTERÉS -->
                        <table id="RetencionInteresTable" class="custTable">
                            <thead>
                                <tr>
                                    <th>Año</th>
                                    <th>Tasa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    getRetencionInteres($connection);
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div style="overflow-x: scroll;" class="section">
                        <p class="h3 mt-3">Índice Nacional de Precios al Consumidor</p>
                        <!-- TABLA DE INPC -->

                        <table id="INPCtable" class="custTable">
                            <thead>
                                <tr>
                                    <th>Año</th>
                                    <th>Enero</th>
                                    <th>Febrero</th>
                                    <th>Marzo</th>
                                    <th>Abril</th>
                                    <th>Mayo</th>
                                    <th>Junio</th>
                                    <th>Julio</th>
                                    <th>Agosto</th>
                                    <th>Septiembre</th>
                                    <th>Octubre</th>
                                    <th>Noviembre</th>
                                    <th>Diciembre</th>
                                </tr>
                            </thead>
                            <tbody id="inpcBody">
                                <?php getINPC($connection); ?>
                            </tbody>
                        </table>
                    </div>


                    <div style="overflow-x: scroll;" class="section">
                        <p class="h3 mt-3">Recargos</p>
                        <!-- TABLA DE RECARGOS -->

                        <table id="recargosTable" class="custTable">
                            <thead>
                                <tr>
                                    <th>Año</th>
                                    <th>Enero</th>
                                    <th>Febrero</th>
                                    <th>Marzo</th>
                                    <th>Abril</th>
                                    <th>Mayo</th>
                                    <th>Junio</th>
                                    <th>Julio</th>
                                    <th>Agosto</th>
                                    <th>Septiembre</th>
                                    <th>Octubre</th>
                                    <th>Noviembre</th>
                                    <th>Diciembre</th>
                                </tr>
                            </thead>
                            <tbody id="recargosBody">
                                <?php getRecargos($connection); ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>