var json;
var name;

document.getElementById("seccion1").style.display = "block";

function enableSection(actual, next) {
    document.getElementById(actual).style.display = "none";
    document.getElementById(next).style.display = "block";
}

function disableSection(actual, previous) {
    document.getElementById(actual).style.display = "none";
    document.getElementById(previous).style.display = "block";
}



// Sección 1
function setName () {
    let name = document.getElementById("prod_name").value;

    document.getElementById("prod_header1").innerText = "Insumos directos aplicados en " + name;
    document.getElementById("prod_header2").innerText = "Distribucion de costos de insumos de acuerdo a su uso en " + name;

    // Definir en las columnas de la sección 3
    this.name = name;
}

// Sección 2
function readData() {
    json = tableToJson();
    
        var table = document.getElementById('tabla-prorrateo').getElementsByTagName('tbody')[0];
        table.innerHTML = '';
    
        var name = document.getElementById('prod_name').value;

        var rowIndex = 0;

        json.forEach (function(insumo, index) {
            if (insumo.unit === "Día") {
                let newObject = {
                    "number": null,
                    "description": "Seguridad e impuestos - "+insumo.description,
                    "unit": insumo.unit,
                    "price": "",
                    "amount": insumo.description
                };

                json.push (newObject);
            }
        });

        console.log (json);
    
        json.forEach(function(insumo, index) {
            var row = table.insertRow();
            var numeroCell = row.insertCell(0);
            var descripcionCell = row.insertCell(1);
            var cantidadCell = row.insertCell(2);

            
            if (insumo.number !== null) {
                console.log("coincidencia");
                numeroCell.innerHTML = index + 1;  // Ajuste para mostrar el número correcto
                descripcionCell.innerHTML = "¿Para cuántos " + name.toLowerCase() + " alcanza cada " + insumo.unit.toLowerCase() + " de " + insumo.description.toLowerCase() + "?";
                cantidadCell.innerHTML = '<input type="number" min="0" step="1"/>';
            } 
            
        });

        console.log(json);
}


// Sección 3
function distribucion() {
    var table = document.getElementById('tabla-prorrateo');
        var rows = table.getElementsByTagName('tr');
    
        // Iterar sobre todas las filas
        for (let i = 0; i < rows.length; i++) {
            let row = rows[i];
            let input = row.cells[2].querySelector('input');
    
            if (input) {
                let valorInput = input.value;
                json[i].amount = valorInput;  // Ajuste del índice del JSON
            }
        }
    
        console.log(JSON.stringify(json, null, 2));

    enableSection("seccion3", "seccion4");
}

    // Confirmar distribución y mostrar resultado
function costTable() {
    let table = document.getElementById("tabla-costeo");
    var data = json;

    var costoTotal = 0;
/*
    // Limpiar la tabla
    tableBody.innerHTML = "";

    // Iterar en el JSON
    data.forEach(item => {
        // Nueva fila
        const row = document.createElement("tr");

        // Crear celdas de la fila
        Object.values(item).forEach(value => {
            const cell = document.createElement("td");
            cell.textContent = value;
            row.appendChild(cell);
        });

        tableBody.appendChild(row);
    });
*/
    while(table.rows.length > 1) {
        table.deleteRow(1);
    }

    var previousItems = [];

    data.forEach(function(item) {

        // Crear una nueva fila
        var row = table.insertRow();

        // Insertar celdas con los datos del JSON en la fila
        var cellNo = row.insertCell(0);
        var cellInput = row.insertCell(1);
        var cellAmount = row.insertCell(2);
        var cellUnit = row.insertCell(3);
        var cellCost = row.insertCell(4);

        // Asignar los valores del JSON a las celdas

        if (item.number == null) { // Impuestos y seguridad

            cellNo.textContext = "";
            cellInput.textContent = item.description;
            cellAmount.textContent = "";
            cellUnit.textContent = item.unit;

            for (var i = 0; i < previousItems.length; i++) {
                if (previousItems[i].description == item.amount) {
                    let cost = ((1/previousItems[i].amount * previousItems[i].price) * 0.35);
                    cellCost.textContent = "$ " + cost.toFixed(2);
                    costoTotal += cost;
                }
            }

        } else {
            let cost = (1/item.amount * item.price);

            cellNo.textContent = item.number;
            cellInput.textContent = item.description;
            cellAmount.textContent = (1 / item.amount).toFixed(3);
            cellUnit.textContent = item.unit;
            cellCost.textContent = "$ " + cost.toFixed(2);

            costoTotal += cost;

            previousItems.push(item);
        }
    });

    document.getElementById("totalCost").textContent = costoTotal.toFixed(2);
}









// Funciones extra
function tableToJson() {
    // Obtener la tabla
    var table = document.getElementById('input-table');

    // Arreglo para guardar los datos
    var data = [];

    // Recorrer la tabla
    for (var i = 1; i < table.rows.length; i++) {
        var row = table.rows[i];
        var rowData = {};

        // Recorrer las celdas de la fila
        for (var j = 0; j < row.cells.length; j++) {
            var cell = row.cells[j];
            var header = table.rows[0].cells[j].id;

            // Guardar el valor de la celda en el objeto JSON usando el nombre de la columna como clave
            if (header === 'description') {
                // Si es la columna de descripción, obtener el valor del input
                // console.log(cell.querySelector('input').value);
                rowData[header] = cell.querySelector('input').value;
            } else if (header === 'unit') {
                // Si es la columna de unidad, obtener el valor seleccionado del select
                var select = cell.querySelector('select');
                rowData[header] = units[select.selectedIndex];
            } else if (header === 'price') {
                // Si es la columna de precio, obtener el valor del input
                rowData[header] = cell.querySelector('input').value;
            } else {
                // Si es cualquier otra columna, obtener el texto directamente
                rowData[header] = cell.innerText;
            }
        }

        // Agregar el campo "amount" vacio al objeto JSON de la fila
        rowData['amount'] = '';

        // Agregar el objeto JSON de la fila al array
        data.push(rowData);
    }

    // Verificamos la realización correcta del JSON
    console.log(JSON.stringify(data, null, 2));

    // Imprimir la cadena JSON en la consola
    return data;
}