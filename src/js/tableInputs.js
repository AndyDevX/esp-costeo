/*
    AGREGAR COMPROBACIÓN:
    SI SE ELIGE 'Trabajador'
    generar distribución extra 'Seguridad social e impuestos'
    Agregar notas con la descripción
*/

let number = 0;
const units = ['Kilogramo', 'Pieza', 'Litro', 'Metro', 'Unidad', 'Costal', 'Paquete', 'Bote', 'Lata', 'Bolsa', 'Tambor', 'Caja', 'Botella', 'Día', 'Kit', 'Lote'];

function newRow () {
    var table = document.getElementById('tabla-insumos');
    number++;

//Crear nueva table row
    let newRow = document.createElement('tr');

//Crear nuevos table data
    //Número
    let newNumber = document.createElement('td');
    newNumber.innerText = number;

    //Descripción
    let newDescription = document.createElement('td');
        //Input
        let newInput = document.createElement('input');
        newInput.setAttribute('type','text');
        newInput.setAttribute('placeholder', 'Descripción del insumo');

    //Unidad
    let newUnit = document.createElement('td');
        //Select
        let newSelect = document.createElement('select');

        //Asignar valores
        for (let i = 0; i < units.length; i++) {
            let newOption = document.createElement('option');
            newOption.setAttribute('value',(i+1));
            newOption.innerHTML = units[i];

            newSelect.appendChild(newOption);
        }
    
    //Precio por unidad
    let newPrice = document.createElement('td');
        //Añadir input
        let newPriceInput = document.createElement('input');
        newPriceInput.setAttribute('type','number');
        newPriceInput.setAttribute('placeholder','Precio por unidad');
        newPriceInput.setAttribute('min','0');
        newPriceInput.setAttribute('step','0.5');

    
    
    //Anidar elementos
    newPrice.appendChild(newPriceInput);
    newDescription.appendChild(newInput);
    newUnit.appendChild(newSelect);
    
    newRow.appendChild(newNumber);
    newRow.appendChild(newDescription);
    newRow.appendChild(newUnit);
    newRow.appendChild(newPrice);

    table.appendChild(newRow);
}