<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda en la misma página</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#buscarBtn").on("click", function() {
                var diaInicial = $("#dia_inicial").val();
                var mesInicial = $("#mes_inicial").val();
                var añoInicial = $("#año_inicial").val();
                var diaFinal = $("#dia_final").val();
                var mesFinal = $("#mes_final").val();
                var añoFinal = $("#año_final").val();
                var contribucionH = $("#contribucion_h").val();

                $.ajax({
                    type: "POST",
                    url: "procesar_formulario.php",
                    data: {
                        dia_inicial: diaInicial,
                        mes_inicial: mesInicial,
                        año_inicial: añoInicial,
                        dia_final: diaFinal,
                        mes_final: mesFinal,
                        año_final: añoFinal,
                        contribucion_h: contribucionH
                    },
                    success: function(data) {
                        $("#resultados").html(data);
                    },
                    error: function() {
                        alert("Error en la petición AJAX");
                    }
                });
            });
        });
    </script>
</head>
<body>

<table frame="none" rules="none">
    <form id="formulario">
        <tr>
            <th>Fecha en que debió pagarse la contribución </th>
            <td>
                <label for="dia_inicial">Día:</label>
                <select name="dia_inicial" id="dia_inicial">
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <label for="mes_inicial">Mes:</label>
                <select name="mes_inicial" id="mes_inicial">
                    <option value=1> Enero </option>
                    <option value=2>Febrero</option>
                    <option value=3>Marzo</option>
                    <option value=4>Abril</option>
                    <option value=5>Mayo</option>
                    <option value=6>Junio</option>
                    <option value=7>Julio</option>
                    <option value=8>Agosto</option>
                    <option value=9>Septiembre</option>
                    <option value=10>Octubre</option>
                    <option value=11>Noviembre</option>
                    <option value=12>Diciembre</option>
                </select>
            </td>
            <td>
                <label for="año_inicial">Año:</label>
                <select name="año_inicial" id="año_inicial">
                    <?php
                    $añoActual = date("Y");
                    for ($i = $añoActual; $i >= 1970; $i--) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <th>Fecha en que se va a pagar la contribución </th>
            <td>
                <label for="dia_final">Día:</label>
                <select name="dia_final" id="dia_final">
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <label for="mes_final">Mes:</label>
                <select name="mes_final" id="mes_final">
                    <option value=1> Enero </option>
                    <option value=2>Febrero</option>
                    <option value=3>Marzo</option>
                    <option value=4>Abril</option>
                    <option value=5>Mayo</option>
                    <option value=6>Junio</option>
                    <option value=7>Julio</option>
                    <option value=8>Agosto</option>
                    <option value=9>Septiembre</option>
                    <option value=10>Octubre</option>
                    <option value=11>Noviembre</option>
                    <option value=12>Diciembre</option>
                </select>
            </td>
            <td>
                <label for="año_final">Año:</label>
                <select name="año_final" id="año_final">
                    <?php
                    $añoActual = date("Y");
                    for ($i = $añoActual; $i >= 1970; $i--) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th align="left">Contribución histórica</th>
            <td colspan="2">
                <label for="contribucion_h">Importe:</label>
                <input type="number" id="contribucion_h" name="contribucion_h" />
            </td>
        </tr>
    </form>
</table>
<!-- Agrega el botón y el contenedor para los resultados -->
<br>
<div style="text-align: center">
    <button type="button" id="buscarBtn">Calcular</button>
    <div id="resultados"></div>
    <div id="resultados2"></div>
    <div id="tabla"></div>
</div>
</body>
</html>