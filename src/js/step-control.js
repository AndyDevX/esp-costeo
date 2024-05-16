// Globales
var json;

//Declarar los contenedores
var name_container = document.getElementById('name-container');
var supply_container = document.getElementById('supply-container');
var distribution_container = document.getElementById('distribution-container');
var investment_container = document.getElementById('investment-container');

function disableContainer (container) {
    var inputs = container.getElementsByTagName('input');
    var buttons = container.getElementsByTagName('button');

    for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = true;
    }
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].disabled = true;
    }

    if (container.id = 'supply-container') {
        var select = container.getElementsByTagName('select');
        for (var j = 0; j < select.length; j++) {
            select[j].disabled = true;
        }
    }
}

function enableContainer (container) {
    var inputs = container.getElementsByTagName('input');
    var buttons = container.getElementsByTagName('button');

    for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = false;
    }
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].disabled = false;
    }

    if (container.id = 'supply-container') {
        var select = container.getElementsByTagName('select');
        for (var j = 0; j < select.length; j++) {
            select[j].disabled = false;
        }
    }
}

//Inicializamos
disableContainer(supply_container);
disableContainer(distribution_container);
disableContainer(investment_container);

//Añadimos la secuencia en orden (1 -> 2 -> 3)
    //Acción al pulsar el único botón del contenedor 1, para pasar al contenedor 2
function confirmName() {
    var name = document.getElementById('product-name').value;

    if(name != "") {
        var supply_header = document.getElementById('supply-header');
        supply_header.innerText = "Insumos directos aplicados a " + name;

        var distribution_header = document.getElementById('distribution-header');
        distribution_header.innerText = "Distribucion de costos de insumos de acuerdo a su uso en " + name;

        disableContainer(name_container);
        enableContainer(supply_container);
    } else {
        alert("El nombre del producto no puede estar vacio");
    }
}

//Acciones del contenedor 2
    function back1 () {
        disableContainer(supply_container);
        enableContainer(name_container);
    }

    function confirmSupply() {
        // AGREGAMOS LA FUNCIONALIDAD PARA GENERAR LOS CAMPOS SEGÚN LA TABLA DE INSUMOS
        // Generamos el JSON
        json = tableToJson();
    
        var table = document.getElementById('tabla-prorrateo').getElementsByTagName('tbody')[0];
        table.innerHTML = '';
    
        var name = document.getElementById('product-name').value;
    
        json.forEach(function(insumo, index) {
            var row = table.insertRow();
            var numeroCell = row.insertCell(0);
            var descripcionCell = row.insertCell(1);
            var cantidadCell = row.insertCell(2);
    
            numeroCell.innerHTML = index + 1;  // Ajuste para mostrar el número correcto
            descripcionCell.innerHTML = "¿Para cuántos " + name.toLowerCase() + " alcanza cada " + insumo.unit.toLowerCase() + " de " + insumo.description.toLowerCase() + "?";
            cantidadCell.innerHTML = '<input type="number" min="0" step="1"/>';
        });

        disableContainer(supply_container);
        enableContainer(distribution_container);
    }
    

//Acciones del contenedor 3
    function back2 () {
        disableContainer(distribution_container);
        enableContainer(supply_container);
    }


    function confirmDistribution() {
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
    }
    
    







    function tableToJson() {
        // Obtener la tabla
        var table = document.getElementById('tabla-insumos');
    
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


    function openModal() {
        var modal = document.getElementById("costeo");
    
        // Obtener el elemento <span> que cierra el modal
        var span = document.getElementsByClassName("close")[0];
    
        // Cuando el usuario haga clic en el botón, abrir el modal
        modal.style.display = "block";
    
        // Cuando el usuario haga clic en <span> (x), cerrar el modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    
        // Cuando el usuario haga clic en cualquier lugar fuera del modal, cerrarlo
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }


        //GENERAR TABLA DE SOLO VISTA
        var jsonData = json;
        var table = document.getElementById('tabla-costeo');

        while (table.rows.length > 1) {
            table.deleteRow(1);
        }

        jsonData.forEach(function(item) {
            // Crear una nueva fila
            var row = table.insertRow();
    
            // Insertar celdas con los datos del JSON en la fila
            var cellNo = row.insertCell(0);
            var cellInput = row.insertCell(1);
            var cellAmount = row.insertCell(2);
            var cellUnit = row.insertCell(3);
            var cellCost = row.insertCell(4);

            // Asignar los valores del JSON a las celdas
            cellNo.textContent = item.number;
            cellInput.textContent = item.description;
            cellAmount.textContent = (1 / item.amount).toFixed(3);
            cellUnit.textContent = item.unit;
            cellCost.textContent = "$ " + (1/item.amount * item.price).toFixed(2);
        });
    }