var costeo_json;
var inversion_json;
var name;

var totalActivos = [];

var datos = {
    "activos": [],
    "preoperativos": [],
    "operativos": []
};

// Primer contenedor de Costeo
document.getElementById ("seccion1").style.display = "block";

// Primer contenedor de Financiamiento
document.getElementById ("seccion5").style.display = "block";

function enableSection (actual, next) {
    document.getElementById (actual).style.display = "none";
    document.getElementById (next).style.display = "block";
}

function disableSection (actual, previous) {
    document.getElementById (actual).style.display = "none";
    document.getElementById (previous).style.display = "block";
}

// Sección 1
function setName () {
    let name = document.getElementById ("prod_name").value;

    if (name === "") {
        alert ("Por favor, ingrese un nombre de producto o servicio");
    } else {
        document.getElementById ("prod_header1").innerText = "Insumos directos aplicados en " + name;
        document.getElementById ("prod_header2").innerText = "Distribucion de costos de insumos de acuerdo a su uso en " + name;

        enableSection ('seccion1', 'seccion2');
        // Definir en las columnas de la sección 3
        this.name = name;
    }
}

// Sección 2
function readData () {
    costeo_json = tableToJson ("input-table");

    var table = document.getElementById ('tabla-prorrateo').getElementsByTagName ('tbody')[0];
    table.innerHTML = '';

    var name = document.getElementById ('prod_name').value;

    var rowIndex = 0;

    costeo_json.forEach (function (insumo, index) {
        if (insumo.unit === "Día") {
            let newObject = {
                "number": null,
                "description": "Seguridad e impuestos - " + insumo.description,
                "unit": insumo.unit,
                "price": "",
                "amount": insumo.description
            };
            
            costeo_json.push (newObject);
        }
    });

    costeo_json.forEach (function (insumo, index) {
        var row = table.insertRow ();
        var numeroCell = row.insertCell (0);
        var descripcionCell = row.insertCell (1);
        var cantidadCell = row.insertCell (2);

        if (insumo.number !== null) {
            console.log ("coincidencia");
            numeroCell.innerHTML = index + 1;  // Ajuste para mostrar el número correcto
            descripcionCell.innerHTML = "¿Para cuántos " + name.toLowerCase () + " alcanza cada " + insumo.unit.toLowerCase () + " de " + insumo.description.toLowerCase () + "?";
            cantidadCell.innerHTML = '<input type="number" min="0" step="1"/>';
        }
    });
}


// Sección 3
function distribucion () {
    var table = document.getElementById ('tabla-prorrateo');
    var rows = table.getElementsByTagName ('tr');

    // Iterar sobre todas las filas
    for (let i = 0; i < rows.length; i++) {
        let row = rows[i];
        let input = row.cells[2].querySelector ('input');

        if (input) {
            let valorInput = input.value;
            costeo_json[i].amount = valorInput;  // Ajuste del índice del JSON
        }
    }

    enableSection ("seccion3", "seccion4");
}

// Confirmar distribución y mostrar resultado
function costTable () {
    let table = document.getElementById ("tabla-costeo");
    let data = costeo_json;

    var costoTotal = 0;

    while (table.rows.length > 1) {
        table.deleteRow (1);
    }

    var previousItems = [];

    data.forEach (function (item) {

        // Crear una nueva fila
        var row = table.insertRow ();

        // Insertar celdas con los datos del JSON en la fila
        var cellNo = row.insertCell (0);
        var cellInput = row.insertCell (1);
        var cellAmount = row.insertCell (2);
        var cellUnit = row.insertCell (3);
        var cellCost = row.insertCell (4);

        // Asignar los valores del JSON a las celdas
        if (item.number == null) { // Impuestos y seguridad
            cellNo.textContext = "";
            cellInput.textContent = item.description;
            cellAmount.textContent = "";
            cellUnit.textContent = item.unit;

            for (var i = 0; i < previousItems.length; i++) {
                if (previousItems[i].description == item.amount) {
                    let cost = ( (1 / previousItems[i].amount * previousItems[i].price) * 0.35);
                    cellCost.textContent = "$ " + cost.toFixed (2);
                    costoTotal += cost;
                }
            }
        } else {
            let cost = (1 / item.amount * item.price);

            cellNo.textContent = item.number;
            cellInput.textContent = item.description;
            cellAmount.textContent = (1 / item.amount).toFixed (3);
            cellUnit.textContent = item.unit;
            cellCost.textContent = "$ " + cost.toFixed (2);

            costoTotal += cost;

            previousItems.push (item);
        }
    });
    document.getElementById ("totalCost").textContent = costoTotal.toLocaleString ('en-US');
}


// Financiamiento
function readFinanciamientoTable(idTabla, tipo) {
    // Limpiamos el campo
    datos[tipo] = [];

    let tabla = document.getElementById(idTabla);
    if (!tabla) {
        console.error(`Tabla con id '${idTabla}' no encontrada.`);
        return;
    }

    let filas = tabla.rows;

    for (let i = 1; i < filas.length; i++) { // Empezamos en 1 para omitir la fila de encabezados
        let celdas = filas[i].cells;
        if (!celdas) {
            console.error(`No se encontraron celdas en la fila ${i}.`);
            continue;
        }

        let objeto = {
            "numero": celdas[0] ? celdas[0].innerText.trim() : '',
            "descripcion": celdas[1] && celdas[1].querySelector('input') ? celdas[1].querySelector('input').value.trim() : '',
            "valor": celdas[2] && celdas[2].querySelector('input') ? celdas[2].querySelector('input').value.trim() : '',
            "periodicidad": celdas[3] && celdas[3].querySelector('select') ? celdas[3].querySelector('select').value.trim() : '',
            "valor_anualizado": celdas[4] ? celdas[4].innerText.trim() : ''
        };

        // Agregar el objeto al array correspondiente en datos
        if (!datos[tipo]) {
            datos[tipo] = [];
        }
        datos[tipo].push(objeto);
    }
    total_datos(tipo, `total${capitalizeFirstLetter(tipo)}Container`, `total${capitalizeFirstLetter(tipo)}`);

    console.log(datos);

    // Ejecutar la función solo para operativos
    if (tipo === "operativos") {
        annualizedValue();
    }
    if (tipo === "activos") {
        calcularDepreciacion();
    }
}


function calcularDepreciacion() {
    let tabla = document.getElementById("actives-table");

    for (let i = 1; i < tabla.rows.length; i++) {
        let row = tabla.rows[i];

        // Leer los datos
        let valor = parseFloat(row.cells[2].getElementsByTagName("input")[0].value);
        let años = parseInt(row.cells[3].getElementsByTagName("input")[0].value)

        // Obtener el porcentaje de depreciación
        let porcentaje = (1 / años);
        let depreciacionAnual = (porcentaje * valor);

        // Mostrar los resultados
        row.cells[4].innerText = (porcentaje * 100).toFixed(2);
        row.cells[5].innerText = depreciacionAnual.toFixed(2);
    }
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

// OBTENER VALORES Y PERIODICIDAD DE LOS GASTOS DE OPERACIÓN PARA CALCULAR VALOR ANUALIZADO
function annualizedValue() {
    let tabla = document.getElementById("operatives-table");
    let filas = tabla.rows;

    // Guardamos la sumatoria
    let totalAnualizado = 0;

    for (let i = 1; i < filas.length; i++) { // Empezamos en 1 para omitir la fila de encabezados
        let celdas = filas[i].cells;
        
        if (celdas.length > 4) { // Asegurarse de que hay al menos 5 celdas en la fila
            let inputColumna3 = celdas[2].querySelector('input');
            let selectColumna4 = celdas[3].querySelector('select');
            
            let valorColumna3 = inputColumna3 ? parseFloat(inputColumna3.value.trim()) : 0;
            let valorColumna4 = selectColumna4 ? parseInt(selectColumna4.value.trim()) : 0;

            console.log(`Fila ${i}, Columna 3 (input): ${valorColumna3}, Columna 4 (select): ${valorColumna4}`);
            // Aquí puedes agregar lógica adicional para trabajar con los valores

            let valorAnualizado = 0;

            switch (valorColumna4) {
                case 1:
                    // Mensual
                    valorAnualizado = valorColumna3 * 12;
                    break;
                case 2:
                    // Bimestral
                    valorAnualizado = valorColumna3 * 6;
                    break;
                case 3:
                    // Trimestral
                    valorAnualizado = valorColumna3 * 4;
                    break;
                case 4:
                    // Cuatrimestral
                    valorAnualizado = valorColumna3 * 3;
                    break;
                case 5:
                    // Semestral
                    valorAnualizado = valorColumna3 * 2;
                    break;
                case 6:
                    // Anual
                    valorAnualizado = valorColumna3;
                    break;
                default:
                    console.error(`Periodicidad no válida en fila ${i}.`);
            }

            // Agregamos a la sumatoria
            totalAnualizado += valorAnualizado;

            // Asignar el valor anualizado a la columna 5
            if (celdas[4]) {
                celdas[4].innerText = valorAnualizado.toFixed(2);
            } else {
                console.error(`La fila ${i} no tiene la celda de la columna 5.`);
            }

        } else {
            console.error(`La fila ${i} no tiene suficientes celdas.`);
        }
    }

    document.getElementById ("totalOperativosContainer").style.display = "block";

    document.getElementById ("totalOperativos").textContent = totalAnualizado.toLocaleString ('en-US');
}

// Obtener valores, suma total y mostrarlo
function total_datos (tipo, containerId, totalId) {
    let items = datos[tipo];

    let total = items.reduce ((sum, item) => {
        let valor = parseFloat (item.valor.replace (/,/g, ''));
        return sum + (isNaN (valor) ? 0 : valor);
    }, 0);

    document.getElementById (containerId).style.display = "block";
    document.getElementById (totalId).textContent = total.toLocaleString ('en-US');
}

// Funciones extra
function tableToJson (tabla) {
    // Obtener la tabla
    var table = document.getElementById (tabla);

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

            if (tabla === "input-table") {
                // Guardar el valor de la celda en el objeto JSON usando el nombre de la columna como clave
                if (header === 'description') {
                    // Si es la columna de descripción, obtener el valor del input
                    // console.log(cell.querySelector('input').value);
                    rowData[header] = cell.querySelector ('input').value;
                } else if (header === 'unit') {
                    // Si es la columna de unidad, obtener el valor seleccionado del select
                    var select = cell.querySelector ('select');
                    rowData[header] = units[select.selectedIndex];
                } else if (header === 'price') {
                    // Si es la columna de precio, obtener el valor del input
                    rowData[header] = cell.querySelector ('input').value;
                } else {
                    // Si es cualquier otra columna, obtener el texto directamente
                    rowData[header] = cell.innerText;
                }
            } else if (tabla === "actives-table") {

                if (header === 'activeDescription') {
                    rowData[header] = cell.querySelector ('input').value;

                } else if (header === 'activeValue') {
                    rowData[header] = cell.querySelector ('input').value;

                } else if (header === 'activeYears') {
                    rowData[header] = cell.querySelector ('input').value;

                } else {
                    rowData[header] = cell.innerText;
                }
            }
        }

        // Agregar el campo "amount" vacio al objeto JSON de la fila
        rowData['amount'] = '';

        // Agregar el objeto JSON de la fila al array
        data.push (rowData);
    }

    // Verificamos la realización correcta del JSON
    console.log (JSON.stringify (data, null, 2));

    // Imprimir la cadena JSON en la consola
    return data;
}