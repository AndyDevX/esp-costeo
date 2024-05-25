<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de inversión</title>
    <link rel="stylesheet" href="../../assets/style.css">
</head>
<body>

    <div id="main">



        <div class="container" id="actives-container">
            <h1>Inversión requerida en activos</h1>
            <h3>Lista de activos, mobiliario, equipo e inmuebles necesarios al inicio del proyecto</h4>
            <div class="table-wrapper">
                <table id="actives-table">
                    <tr>
                        <th>No</th>
                        <th>Descripción</th>
                        <th>Valor</th>
                        <th>Años de vida útil</th>
                    </tr>
                    
                </table>
            </div>

            <div class="btn-group" id="actives-investment">
                <button onclick="newRow()">Nuevo activo</button>
                <button>Confirmar activos</button>
                <button>Modificar activos</button>
            </div>
        </div>



        <div class="container" id="preoperativos-container">
            <h1>Gastos preoperativos</h1>
            <h3>Lista de gastos a realizar previamente a la puesta en marcha del proyecto</h3>
            <div class="table-wrapper">
                <table id="preoperativos-table">
                    <tr>
                        <th>No</th>
                        <th>Descripción</th>
                        <th>Valor</th>
                    </tr>
                    
                </table>
            </div>

            <div class="btn-group" id="btns-preoperativos">
                <button>Nuevo gasto preoperativo</button>
                <button>Confirmar gastos preoperativos</button>
                <button>Modificar gastos preoperativos</button>
            </div>
        </div>



        <div class="container" id="operacion-container">
            <h1>Gastos de operación</h1>
            <h3>Lista de gastos de operación independientemente de su periodicidad (mes, bimestre o año)</h3>
            <div class="table-wrapper">
                <table id="operacion-table">
                    <tr>
                        <th>No</th>
                        <th>Descripción</th>
                        <th>Valor</th>
                        <th>Periodicidad</th>
                        <th>Valor anualizado</th>
                    </tr>
                    
                </table>
            </div>

            <div class="btn-group" id="btns-operacion">
                <button>Nuevo gasto preoperativo</button>
                <button>Confirmar gastos de operación</button>
                <button>Modificar gastos de operación</button>
            </div>
        </div>



        <button onclick="back('../../index.html')" class="back-btn">Volver</button>

    </div>
    
</body>

<script>
    let num = 0;

    function newRow() {
        var table =document.getElementById('actives-table');
        num++;

        let newRow = document.createElement('tr');

        let newNum = document.createElement('td');
        newNum.innerText = num;

        let newDescription = document.createElement('td');
            let newInput = document.createElement('input');
            newInput.setAttribute('type', 'text');
            newInput.setAttribute('placeholder', 'Descripción del activo');

        let newValue = document.createElement('td');
            let newInput2 = document.createElement('input');
            newInput2.setAttribute('type', 'number');
            newInput2.setAttribute('min', '0');
            newInput2.setAttribute('placeholder', 'Valor del activo');

        let newUtility = document.createElement('td');
            let newInput3 = document.createElement('input');
            newInput3.setAttribute('type', 'number');
            newInput3.setAttribute('min', '0');
            newInput3.setAttribute('placeholder', 'Vida útil del activo');


    //Anidar elementos
        //Descripción
        newDescription.appendChild(newInput);

        //Valor
        newValue.appendChild(newInput2);

        //Utilidad
        newUtility.appendChild(newInput3);

        newRow.appendChild(newNum);
        newRow.appendChild(newDescription);
        newRow.appendChild(newValue);
        newRow.appendChild(newUtility);

        table.appendChild(newRow);
    }
</script>

<script src="../../src/js/back.js"></script>
<script src="../../src/js/investment_control.js"></script>

</html>