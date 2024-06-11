<?php
    include ("../../src/php/conexion.php");
    include ("modules/getData.php");
    include ("../../src/php/session_check.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indicadores</title>

    <link rel="shortcut icon" href="../../assets/img/esp-logo.jpeg" type="image/x-icon">

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

                <style>
                    .accordion {
                        width: 100%;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        background-color: #fff;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    }

                    .accordion-item {
                        border-bottom: 1px solid #ccc;
                    }

                    .accordion-item:last-child {
                        border-bottom: none;
                    }

                    .accordion-header {
                        width: 100%;
                        padding: 15px;
                        text-align: left;
                        color: white;
                        background: rgb(66, 66, 66);
                        border: none;
                        outline: none;
                        cursor: pointer;
                        transition: background 0.3s ease;
                    }

                    .accordion-header:hover {
                        background: rgb(150, 150, 150);
                    }

                    .accordion-content {
                        padding: 15px;
                        display: none;
                        border-top: 1px solid #ccc;
                        background-color: rgb(102, 102, 102);
                        overflow-x: auto;
                    }
                </style>

                <p class="h1">Indicadores</p>

                <div class="accordion">
                    <div class="accordion-item">
                        <button class="accordion-header">UMI</button>
                        <div class="accordion-content">

                            <p class="h3">Unidad Mixta Infonavit</p>
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
                    </div>

                    <div class="accordion-item">
                        <button class="accordion-header">UMA</button>
                        <div class="accordion-content">
                        
                            <p class="h3 mt-3">Unidad de Medida y Actualización</p>
                        
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
                    </div>

                    <div class="accordion-item">
                        <button class="accordion-header">Retención de interés</button>
                        <div class="accordion-content">
                            
                            <p class="h3 mt-3">Retención de interés</p>
                            
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
                    </div>

                    <div class="accordion-item">
                        <button class="accordion-header">INPC</button>
                        <div class="accordion-content">
                            
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
                    </div>

                    <div class="accordion-item">
                        <button class="accordion-header">Recargos</button>
                        <div class="accordion-content">
                            
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

                    <div class="accordion-item">
                        <button class="accordion-header">Sección</button>
                        <div class="accordion-content">
                            <p>Contenido de la sección</p>
                        </div>
                    </div>

                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                    var accHeaders = document.querySelectorAll('.accordion-header');

                    accHeaders.forEach(function (header) {
                        header.addEventListener('click', function () {
                            var content = this.nextElementSibling;

                            // Toggle the visibility of the current content
                            if (content.style.display === 'block') {
                                content.style.display = 'none';
                            } else {
                                // Close all other open contents
                                document.querySelectorAll('.accordion-content').forEach(function (item) {
                                    item.style.display = 'none';
                                });

                                // Open the clicked content
                                content.style.display = 'block';
                            }
                        });
                    });
                });
                </script>
                
            </div>
        </div>
    </div>

</body>

</html>