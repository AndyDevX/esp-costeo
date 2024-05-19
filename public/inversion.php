<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de inversión</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

    <div id="main">

        <div class="container" id="investment-container">
            <h3>Inversión requerida en activos</h3>
            <div class="table-wrapper">
                <table id="">
                    <tr>
                        <th>No</th>
                        <th>Descripción</th>
                        <th>Valor</th>
                        <th>Años de vida útil</th>
                    </tr>
                    
                    <tr>
                        <td>1</td>
                        <td><input type="text" value="Computadora"></td>
                        <td><input type="number" min="0" value="60000"></td>
                        <td><input type="number" min="0" value="5"></td>
                    </tr>
                </table>
            </div>

            <div class="btn-group" id="btns-investment">
                <button>Nuevo activo</button>
                <button>Confirmar activos</button>
                <button>Modificar activos</button>
            </div>


        </div>

    </div>
    
</body>
</html>