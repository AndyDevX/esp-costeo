function validateTable() {
    const table = document.getElementById('input-table');
    const tbody = table.getElementsByTagName('tbody')[0];
    const rows = tbody.getElementsByTagName('tr');

    if (rows.length === 0) {
        alert('La tabla no tiene filas.');
        return;
    }

    for (let i = 0; i < rows.length; i++) {
        const inputs = rows[i].querySelectorAll('input');
        const select = rows[i].querySelector('select');

        if (inputs.length > 1 && (!inputs[0].value.trim() || !select.value || !inputs[1].value.trim())) {
            alert('Existen filas con campos vacíos.');
            return;
        }
    }

    alert('La tabla tiene filas con datos completos.');
}