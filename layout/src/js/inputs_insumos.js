const units = ['Kilogramo', 'Pieza', 'Litro', 'Metro', 'Unidad', 'Costal', 'Paquete', 'Bote', 'Lata', 'Bolsa', 'Tambor', 'Caja', 'Botella', 'Día', 'Kit', 'Lote'];
let insumos_number = 0;

function RowInputs () {
    insumos_number++;

    // Determinamos la tabla
    let table = document.getElementById('input-table');
    let newRow = document.createElement('tr');
        // Generamos el número de índice
        let newNumber = document.createElement('td');
        newNumber.innerText = insumos_number;
        newNumber.setAttribute('class', 'columna1');
        
        // Creamos la celda
        let newDescription = document.createElement('td');
            // Creamos el input
            let newInput = document.createElement('input');
            newInput.setAttribute('type','text');
            newInput.setAttribute('placeholder', 'Descripción del insumo');
        newDescription.setAttribute('class', 'columna2');

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
        newUnit.setAttribute('class', 'columna3');

        // Precio por unidad
        let newPrice = document.createElement('td');
            // Añadir input
            let newPriceInput = document.createElement('input');
            newPriceInput.setAttribute('type','number');
            newPriceInput.setAttribute('placeholder','Precio por unidad');
            newPriceInput.setAttribute('min','0');
            newPriceInput.setAttribute('step','0.5');
        newPrice.setAttribute('class', 'columna4');

        // Anidamos los elementos
        newPrice.appendChild(newPriceInput);
        newDescription.appendChild(newInput);
        newUnit.appendChild(newSelect);
        
        newRow.appendChild(newNumber);
        newRow.appendChild(newDescription);
        newRow.appendChild(newUnit);
        newRow.appendChild(newPrice);

    table.appendChild(newRow);
}