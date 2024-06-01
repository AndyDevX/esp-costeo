const units = ['Kilogramo', 'Pieza', 'Litro', 'Metro', 'Unidad', 'Costal', 'Paquete', 'Bote', 'Lata', 'Bolsa', 'Tambor', 'Caja', 'Botella', 'Día', 'Kit', 'Lote'];
var number = 0;

function addInput (tableID) {
    number++;

    // Determinamos la tabla
    let table = document.getElementById(tableID);
    let newRow = document.createElement('tr');
    let newNumber = document.createElement('td');
    newNumber.innerText = number;

    switch (tableID) {
        case 'input-table':
            // Creamos la celda
            let newDescription = document.createElement('td');
                // Creamos el input
                let newInput = document.createElement('input');
                newInput.setAttribute('type','text');
                newInput.setAttribute('placeholder', 'Descripción del insumo');

            // Celda para unidad
            let newUnit = document.createElement('td');
                // Select
                let newSelect = document.createElement('select');
        
                // Asignar valores
                for (let i = 0; i < units.length; i++) {
                    let newOption = document.createElement('option');
                    newOption.setAttribute('value',(i+1));
                    newOption.innerHTML = units[i];
        
                    newSelect.appendChild(newOption);
                }

            // Precio por unidad
            let newPrice = document.createElement('td');
                // Añadir input
                let newPriceInput = document.createElement('input');
                newPriceInput.setAttribute('type','number');
                newPriceInput.setAttribute('placeholder','Precio por unidad');
                newPriceInput.setAttribute('min','0');
                newPriceInput.setAttribute('step','0.5');

            // Anidamos los elementos
            newPrice.appendChild(newPriceInput);
            newDescription.appendChild(newInput);
            newUnit.appendChild(newSelect);
            
            newRow.appendChild(newNumber);
            newRow.appendChild(newDescription);
            newRow.appendChild(newUnit);
            newRow.appendChild(newPrice);

            break;

        case 'distribution-table':
            // Creamos la celda
            // Generar a través del JSON
            break;

        case 'actives-table':
            let newDescription = document.createElement()
            break;

        case 'preoperatives-table':
            break;

        case 'operatives-table':
            break;
    }

    table.appendChild(newRow);
}