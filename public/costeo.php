<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de costeo</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div id="main">

        <div id="name-container" class="container">
            <h1>Producto o servico unitario del cual se calculará el costo</h1>
            <input id="product-name" type="text" placeholder="Nombre del producto o servicio">
            
            <div class="btn-group" id="btns-prorrateo">
                <button onclick="confirmName()">Asignar nombre</button>
            </div>
        </div>    

        <div id="supply-container" class="container">
            <h1 id="supply-header">Insumos directos aplicados al producto o servicio </h1>
            <!-- Tabla de insumos -->
            <div class="table-wrapper">
                <table id="tabla-insumos">
                    <tr>
                        <th id="number">No</td>
                        <th id="description">Descripción</td>
                        <th id="unit">Se compra por</td>
                        <th id="price">Precio por unidad</td>
                    </tr>
                </table>
            </div>

            <div class="btn-group" id="btns-insumos">
                <button onclick="newRow()">Nuevo insumo</button>
                <button onclick="confirmSupply()">Confirmar insumos</button>
                <button onclick="back1()">Volver</button>
            </div>

        </div>

        <div id="distribution-container" class="container">
            <h1 id="distribution-header">Distribucion de costos de insumos de acuerdo a su uso en los productos o servicios</h1>

            <div class="table-wrapper">
                <table id="tabla-prorrateo">
                    <tr>
                        <th id="number">No</td>
                        <th id="supply">Insumo</td>
                        <th id="amount">Cantidad</td>
                    </tr>
                </table>
            </div>

            <div class="btn-group" id="btns-prorrateo">
                <button onclick="confirmDistribution(), openModal()">Confirmar distribuciones</button>
                <button onclick="back2()">Volver</button>
            </div>

        </div>

        <button onclick="back('../index.html')" class="back-btn">Volver</button>

    </div>



    <div class="modal" id="costeo">
        <div class="modal-content">
            <div><span class="close">&times;</span></div>
            
            <div>
                <h1>Costeo</h1>

                <div class="table-wrapper">
                    <table id="tabla-costeo">
                        <tr>
                            <th>No</th>
                            <th>Insumo</th>
                            <th>Cantidad</th>
                            <th>Unidad</th>
                            <th>Costo</th>
                        </tr>
                        
                    </table>
                </div>
            </div>

        </div>
    </div>


</body>

<script src="../src/js/generatePDF.js"></script>
<script src="../src/js/tableInputs.js"></script>
<script src="../src/js/step-control.js"></script>
<script src="../src/js/back.js"></script>

</html>