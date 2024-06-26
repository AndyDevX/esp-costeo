<?php
    include ("../../src/php/session_check.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora financiera</title>
    
    <link rel="shortcut icon" href="../../assets/img/esp-logo.jpeg" type="image/x-icon">
    
    <!-- Estilos propios -->
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="bg-image d-flex justify-content-center align-items-center">
        <div class="custom-container text-center">

            <button class="btn btn-primary" id="top-back" onclick="window.location.href='../menu.php';">Volver</button>

            <div class="content">
                <p class="h1 mb-3" id="form-title">Calculadora financiera</p>
                <hr>

                <div class="row">
                    <p class="h2">Costeo</p>

                    <div id="seccion1" class="section">
                        <p class="h4 mt-4">Producto o servico unitario del cual se calculará el costo</p>
                        <input id="prod_name" class="mb-2" type="text" placeholder="Nombre del producto o servicio">
                        <button style="width: fit-content; margin: 0 auto;" onclick="setName()" class="btn btn-primary">Asignar nombre</button>
                    </div>
                    
                    <div id="seccion2" class="section">
                        <p id="prod_header1" class="h4 mt-4">Insumos directos aplicados al producto o servicio</p>
                        <table id="input-table" class="custTable">
                            <thead>
                                <tr>
                                    <th id="number" class="columna1">#</th>
                                    <th id="description" class="columna2">Descripción</th>
                                    <th id="unit" class="columna3">Se compra por</th>
                                    <th id="price" class="columna4">Precio por unidad</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <div class="custom-button-group">
                            <button onclick="RowInputs()" class="btn btn-primary btn-sm">Nuevo insumo</button>
                            <button onclick="enableSection('seccion2', 'seccion3'), readData()" class="btn btn-primary btn-sm">Confirmar insumos</button>
                            <button onclick="disableSection('seccion2', 'seccion1')" class="btn btn-primary btn-sm">Volver</button>
                        </div>
                    </div>

                    <div id="seccion3" class="section">
                        <p id="prod_header2" class="h4 mt-4">Distribucion de costos de insumos de acuerdo a su uso en los productos o servicios</p>
                        <table id="tabla-prorrateo" class="custTable">
                            <tr>
                                <th class="columna1">#</th>
                                <th class="columna2">Insumo</th>
                                <th class="columna3">Cantidad</th>
                            </tr>
                        </table>

                        <div class="custom-button-group">
                            <button onclick="distribucion(), costTable()" class="btn btn-primary btn-sm">Confirmar distribuciones</button>
                            <button onclick="disableSection('seccion3', 'seccion2')" class="btn btn-primary btn-sm">Volver</button>
                        </div>
                    </div>

                    <div id="seccion4" class="section">
                        <p class="h4 mt-4">Costeo unitario de cada producto o servicios proporcionado considerando los insumos registrados</p>
                        <table id="tabla-costeo" class="custTable">
                            <thead>
                                <tr>
                                    <th class="columna1">#</th>
                                    <th class="columna2">Insumo</th>
                                    <th class="columna3">Cantidad</th>
                                    <th class="columna4">Unidad</th>
                                    <th class="columna5">Costo</th>
                                </tr>
                            </thead>
                            <tbody id="costeo-body">
                                <!-- Filas creadas -->
                            </tbody>
                        </table>
                        <!-- De aquí sacaremos el total para los siguientes cálculos -->
                        <p class="h5">Costeo total: $<span id="totalCost"></span></p>
                        <button onclick="disableSection('seccion4', 'seccion3')" style="width: fit-content; margin: 0 auto;" class="btn btn-primary">Modificar distribución</button>
                    </div>

                </div>

                <hr>
                <hr>

                <div class="row">
                    <p class="h2">Inversión</p>

                    <div id="seccion5" class="section">
                        <p class="h4">Inversión requerida en activos</p>
                        <p class="h5">Lista de activos, mobiliario, equipo e inmuebles necesarios al inicio del proyecto</p>

                        <table id="actives-table" class="custTable">
                            <tr>
                                <th id="activeNumber" class="columna1">#</th>
                                <th id="activeDescription" class="columna2">Descripción</th>
                                <th id="activeValue" class="columna3">Valor</th>
                                <th id="activeYears" class="columna4">Años de vida útil</th>
                                <th id="activePercent" class="columna5">%</th>
                                <th id="activeDepreciation" class="columna6">Depreciación anual</th>
                            </tr>
                        </table>

                        <div class="custom-button-group">
                            <button onclick="RowActives()" class="btn btn-primary btn-sm">Nuevo activo</button>
                            <button onclick="openSection('seccion6'), readFinanciamientoTable('actives-table', 'activos')" class="btn btn-primary btn-sm">Confirmar activos</button>
                        </div>

                        <p class="h5" id="totalActivosContainer" style="display: none;">Suma de inversión requerida en activos: $<span id="totalActivos"></span></p>
                        <p class="h5" id="totalDepreciacionContainer" style="display: none;">Total de depreciación anual de activos: $<span id="totalDepreciacion"></span></p>
                    </div>

                    <div id="seccion6" class="section">
                        <p class="h4 mt-3">Gastos preoperativos</p>
                        <p class="h5">Lista de gastos a realizar previamente a la puesta en marcha del proyecto</p>

                        <table id="preoperatives-table" class="custTable">
                            <tr>
                                <th class="columna1">#</th>
                                <th class="columna2">Descripción</th>
                                <th class="columna3">Valor</th>
                            </tr>
                        </table>

                        <div class="custom-button-group">
                            <button onclick="RowPreoperatives()" class="btn btn-primary btn-sm">Nuevo gasto preoperativo</button>
                            <button onclick="openSection('seccion7'), readFinanciamientoTable('preoperatives-table', 'preoperativos')" class="btn btn-primary btn-sm">Confirmar gastos preoperativos</button>
                        </div>

                        <p class="h5" id="totalPreoperativosContainer" style="display: none;">Suma de gastos preoperativos: $<span id="totalPreoperativos"></span></p>
                    </div>

                    <div id="seccion7" class="section">
                        <p class="h4 mt-3">Gastos de operación</p>
                        <p class="h5">Lista de gastos de operación independientemente de su periodicidad (mes, bimestre o año)</p>

                        <table id="operatives-table" class="custTable">
                            <tr>
                                <th class="columna1">#</th>
                                <th class="columna2">Descripción</th>
                                <th class="columna3">Valor</th>
                                <th class="columna4">Periodicidad</th>
                                <th class="columna5">Valor anualizado</th>
                            </tr>
                            
                        </table>

                        <div class="custom-button-group">
                            <button onclick="RowOperatives()" class="btn btn-primary btn-sm">Nuevo gasto de operación</button>
                            <button onclick="readFinanciamientoTable('operatives-table', 'operativos')" class="btn btn-primary btn-sm">Confirmar gastos de operación</button>
                        </div>
                    </div>

                    <p class="h5" id="totalOperativosContainer" style="display: none;">Suma de gastos de operación: $<span id="totalOperativos"></span></p>
                </div>

                <hr>

                <div class="row">
                    <p class="h2">Financiamiento</p>
                </div>
            </div>

        </div>

    </div>

    <!-- Scripts -->
    <script src="../../src/js/actives_inputs.js"></script>
    <script src="../../src/js/inputs_insumos.js"></script>
    <script src="../../src/js/step_control.js"></script>
    <script src="validateTable.js"></script>

</body>

</html>