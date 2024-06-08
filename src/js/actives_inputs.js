let activos_number = 0;
let preoperativos_number = 0;
let operativos_number = 0;
const ItemsPeriodicidad = ['Mensual', 'Bimestral', 'Trimestral', 'Cuatrimestral', 'Semestral', 'Anual'];

function RowActives() {
    activos_number++;

    // Obtenemos la tabla
    let table = document.getElementById('actives-table');
    let newRow = document.createElement('tr');

    // Generamos el número
    let newNumber = document.createElement('td');
    newNumber.innerText = activos_number;
    newNumber.setAttribute('class', 'columna1');

    // Creamos la celda
    let newDescription = document.createElement('td');
        // Creamos el input
        let newInputDescription = document.createElement('input');
        newInputDescription.setAttribute('type','text');
        newInputDescription.setAttribute('placeholder', 'Descripción del activo');
    newDescription.setAttribute('class', 'columna2');

    // Celda para valor
    let newValue = document.createElement('td');
        // Creamos el input
        let newInputValue = document.createElement('input');
        newInputValue.setAttribute('type', 'number');
        newInputValue.setAttribute('placeholder', 'Valor del activo');
        newInputValue.setAttribute('min', '0');
    newValue.setAttribute('class', 'columna3');

    // Creamos la celda para años de vida útil
    let newLife = document.createElement('td');
        // Creamos el input
        let newInputLife = document.createElement('input');
        newInputLife.setAttribute('type', 'number');
        newInputLife.setAttribute('placeholder', 'Años de vida útil del activo');
        newInputLife.setAttribute('min', '0');
    newLife.setAttribute('class', 'columna4');

    // Creamos la celda para el porcentaje de depreciación
    let newDepreciation = document.createElement('td');
        // 
    newDepreciation.setAttribute('class', 'columna5');

    // Creamos la celda para el valor de la depreciación
    let newDepreciationValue = document.createElement('td');
        // 
    newDepreciationValue.setAttribute('class', 'columna6');

    // Anidamos los elementos
    newDescription.appendChild(newInputDescription);
    newValue.appendChild(newInputValue);
    newLife.appendChild(newInputLife);

    newRow.appendChild(newNumber);
    newRow.appendChild(newDescription);
    newRow.appendChild(newValue);
    newRow.appendChild(newLife);
    newRow.appendChild(newDepreciation);
    newRow.appendChild(newDepreciationValue);

    table.appendChild(newRow);
}

function RowPreoperatives () {
    preoperativos_number++;

    // Obtenemos la tabla
    let table = document.getElementById('preoperatives-table');
    let newRow = document.createElement('tr');

    // Generamos el número
    let newNumber = document.createElement('td');
    newNumber.innerText = preoperativos_number;
    newNumber.setAttribute('class', 'columna1');

    // Creamos la celda
    let newDescription = document.createElement('td');
        // Creamos el input
        let newInputDescription = document.createElement('input');
        newInputDescription.setAttribute('type','text');
        newInputDescription.setAttribute('placeholder', 'Descripción del gasto');
    newDescription.setAttribute('class', 'columna2');

    // Celda para valor
    let newValue = document.createElement('td');
        // Creamos el input
        let newInputValue = document.createElement('input');
        newInputValue.setAttribute('type', 'number');
        newInputValue.setAttribute('placeholder', 'Valor del gasto');
        newInputValue.setAttribute('min', '0');
    newValue.setAttribute('class', 'columna3');

    // Anidamos los elementos
    newDescription.appendChild(newInputDescription);
    newValue.appendChild(newInputValue);

    newRow.appendChild(newNumber);
    newRow.appendChild(newDescription);
    newRow.appendChild(newValue);

    table.appendChild(newRow);
}

function RowOperatives () {
    operativos_number++;

    // Obtenemos la tabla
    let table = document.getElementById('operatives-table');
    let newRow = document.createElement('tr');

    // Generamos el número
    let newNumber = document.createElement('td');
    newNumber.innerText = operativos_number;
    newNumber.setAttribute('class', 'columna1');

    // Creamos la celda
    let newDescription = document.createElement('td');
        // Creamos el input
        let newInputDescription = document.createElement('input');
        newInputDescription.setAttribute('type','text');
        newInputDescription.setAttribute('placeholder', 'Descripción del gasto');
    newDescription.setAttribute('class', 'columna2');

    // Celda para valor
    let newValue = document.createElement('td');
        // Creamos el input
        let newInputValue = document.createElement('input');
        newInputValue.setAttribute('type', 'number');
        newInputValue.setAttribute('placeholder', 'Valor del gasto');
        newInputValue.setAttribute('min', '0');
    newValue.setAttribute('class', 'columna3');

    // Celda para periodicidad
    let newPeriod = document.createElement('td');
        // Select
        let newSelect = document.createElement('select');
        // Asignar valores
        for (let i = 0; i < ItemsPeriodicidad.length; i++) {
            let newOption = document.createElement('option');
            newOption.setAttribute('value',(i+1));
            newOption.innerHTML = ItemsPeriodicidad[i];

            newSelect.appendChild(newOption);
        }
    newPeriod.setAttribute('class', 'columna4');

    // Celda para valor anualizado
    let newAnnualValue = document.createElement('td');
        // Creamos el valor
        newAnnualValue.innerHTML = "Falta por calcular";

    // Anidamos los elementos
    newDescription.appendChild(newInputDescription);
    newValue.appendChild(newInputValue);
    newPeriod.appendChild(newSelect);

    newRow.appendChild(newNumber);
    newRow.appendChild(newDescription);
    newRow.appendChild(newValue);
    newRow.appendChild(newPeriod);
    newRow.appendChild(newAnnualValue);

    table.appendChild(newRow);
}