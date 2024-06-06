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
function readFinanciamientoTable (idTabla, tipo) {
    let tabla = document.getElementById (idTabla);
    let filas = tabla.rows;

    for (let i = 1; i < filas.length; i++) { // Empezamos en 1 para omitir la fila de encabezados
        let celdas = filas[i].cells;
        let objeto = {
            "numero": celdas[0].innerText.trim (),
            "descripcion": celdas[1].querySelector ('input') ? celdas[1].querySelector ('input').value.trim () : '',
            "valor": celdas[2].querySelector ('input') ? celdas[2].querySelector ('input').value.trim () : ''
        };

        // Opcionalmente agregar campos específicos si existen
        if (celdas[3] && celdas[3].querySelector ('input')) {
            objeto["años"] = celdas[3].querySelector ('input').value.trim ();
        }
        if (celdas[4] && celdas[4].querySelector ('input')) {
            objeto["periodicidad"] = celdas[4].querySelector ('input').value.trim ();
        }
        if (celdas[5] && celdas[5].querySelector ('input')) {
            objeto["valor_anualizado"] = celdas[5].querySelector ('input').value.trim ();
        }

        // Agregar el objeto al array correspondiente en datos
        if (!datos[tipo]) {
            datos[tipo] = [];
        }
        datos[tipo].push (objeto);
    }
    total_datos (tipo, `total${capitalizeFirstLetter (tipo)}Container`, `total${capitalizeFirstLetter (tipo)}`);
}

function capitalizeFirstLetter (string) {
    return string.charAt (0).toUpperCase () + string.slice (1);
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