<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Suma de Fechas</title>
</head>
<body>

<?php
// Definir variables para los valores predeterminados y el resultado
$fechaInicio = "";
$diasSumar = "";
$diasNoSumar = [];
$fechaResultante = "";
$dias_inhabiles = array(
$i_enero = false,
$iii_febrero = false,
$iii_marzo=false,
$i_mayo = false,
$v_mayo = false,
$xvi_septiembre = false,
$iii_noviembre = false,
$i_diciembre = false,
);

// Verificar si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado la fecha de inicio
    if (isset($_POST["fecha_inicio"]) && !empty($_POST["fecha_inicio"])) {
        $fechaInicio = $_POST["fecha_inicio"];
    } else {
        echo "La fecha de inicio no ha sido proporcionada.<br>";
    }

    // Verificar si se ha enviado la cantidad de días a sumar
    if (isset($_POST["dias_sumar"]) && $_POST["dias_sumar"] > 0) {
        $diasSumar = $_POST["dias_sumar"];
    } else {
        echo "La cantidad de días a sumar no es válida.<br>";
    }

    // Verificar si se han seleccionado días para no sumar
    if (isset($_POST["dias_no_sumar"]) && !empty($_POST["dias_no_sumar"])) {
        $diasNoSumar = $_POST["dias_no_sumar"];
    }

    // Si todos los campos son válidos, calcular la fecha resultante
    if (!empty($fechaInicio) && !empty($diasSumar)) {
        $fechaResultante = sumarDiasHabiles($fechaInicio, $diasSumar, $diasNoSumar);
    }
}

// Función para sumar días excluyendo ciertos días de la semana
function sumarDiasHabiles($fechaInicio, $diasSumar, $diasNoSumar) {
    $fecha = strtotime($fechaInicio);

    for ($i = 0; $i < $diasSumar; $i++) {
        $fecha = strtotime('+1 day', $fecha);

        while (in_array(date('N', $fecha), $diasNoSumar)) {
            $fecha = strtotime('+1 day', $fecha);
        }
    }

    return date('d-m-Y', $fecha);
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="fecha_inicio">Fecha de inicio:</label>
    <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fechaInicio; ?>" required><br><br>
    
    <label for="dias_sumar">Días a sumar:</label>
    <input type="number" id="dias_sumar" name="dias_sumar" min="1" value="<?php echo $diasSumar; ?>" required><br><br>

    <label for="dias_no_sumar">Días a excluir:</label><br>
    <input type="checkbox" id="lunes" name="dias_no_sumar[]" value="1" <?php if(in_array("1", $diasNoSumar)) echo "checked"; ?>>
    <label for="lunes">Lunes</label><br>
    <input type="checkbox" id="martes" name="dias_no_sumar[]" value="2" <?php if(in_array("2", $diasNoSumar)) echo "checked"; ?>>
    <label for="martes">Martes</label><br>
    <input type="checkbox" id="miercoles" name="dias_no_sumar[]" value="3" <?php if(in_array("3", $diasNoSumar)) echo "checked"; ?>>
    <label for="miercoles">Miércoles</label><br>
    <input type="checkbox" id="jueves" name="dias_no_sumar[]" value="4" <?php if(in_array("4", $diasNoSumar)) echo "checked"; ?>>
    <label for="jueves">Jueves</label><br>
    <input type="checkbox" id="viernes" name="dias_no_sumar[]" value="5" <?php if(in_array("5", $diasNoSumar)) echo "checked"; ?>>
    <label for="viernes">Viernes</label><br>
    <input type="checkbox" id="sabado" name="dias_no_sumar[]" value="6" <?php if(in_array("6", $diasNoSumar)) echo "checked"; ?>>
    <label for="sabado">Sábado</label><br>
    <input type="checkbox" id="domingo" name="dias_no_sumar[]" value="7" <?php if(in_array("7", $diasNoSumar)) echo "checked"; ?>>
    <label for="domingo">Domingo</label><br><br>
<div>
        
      
    <label for="dias_no_sumar">Día inhabil:</label><br>
    <input type="checkbox" id="1 de enero" name="dias_no_sumar[]" value="01-01" <?php if($i_enero) echo "checked"; ?>>
    <label for="lunes">1 de enero</label><br>
    <input type="checkbox" id="martes" name="dias_no_sumar[]" value="1" <?php if( $iii_febrero) echo "checked"; ?>>
    <label for="martes">1° lunes de febrero </label><br>

</div>
<div>

    <input type="submit" value="Calcular Fecha Resultante">
    <input type="button" value="Limpiar Formulario" onclick="limpiarFormulario()">
</div>
</form>

<?php
// Mostrar la fecha resultante si está definida
if (!empty($fechaResultante)) {
    echo "<p id='resultado'>La fecha resultante es: $fechaResultante</p>";
}
?>

<script>
    function limpiarFormulario() {
        document.getElementById('fecha_inicio').value = '';
        document.getElementById('dias_sumar').value = '';
        var checkboxes = document.querySelectorAll('input[type=checkbox]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = false;
        }
        document.getElementById('resultado').style.display = 'none';
    }
</script>

</body>
</html>
