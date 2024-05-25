<?php
// Definir variables para los valores predeterminados y el resultado
$fechaInicio = "";
$diasSumar = "";
$diasNoSumar = [];
$fechaResultante = "";

// Definir las variables para los días inhabilitados
$i_enero = '01-01-' . date('Y');
$i_febrero = '';
$iii_marzo = '';
$i_mayo = '01-05-' . date('Y');
$v_mayo = '05-05-' . date('Y');
$xvi_septiembre = '16-09-' . date('Y');
$iii_noviembre = '';
$i_diciembre = '01-12-' . date('Y');
$xxv_diciembre = '25-12-' . date('Y');

// Encontrar el primer lunes de febrero
$primerLunesFebrero = strtotime('first Monday of February');
if (date('m', $primerLunesFebrero) == 2) {
    $i_febrero = date('d-m-Y', $primerLunesFebrero);
} else {
    // Si el primer lunes de febrero no está en febrero, buscar el siguiente lunes
    $primerLunesFebrero = strtotime('first Monday of February +1 week');
    $i_febrero = date('d-m-Y', $primerLunesFebrero);
}

// Definir el array de días inhabilitados
$dias_inhabiles = [
    $i_enero => false,
    $i_febrero => false,
    $iii_marzo => false,
    $i_mayo => false,
    $v_mayo => false,
    $xvi_septiembre => false,
    $iii_noviembre => false,
    $i_diciembre => false,
    $xxv_diciembre => false
];

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
        
        // Marcar los días inhabilitados según la selección de los checkboxes
        foreach ($diasNoSumar as $diaNoSumar) {
            if (isset($dias_inhabiles[$diaNoSumar])) {
                $dias_inhabiles[$diaNoSumar] = true;
            }
        }
    }

    // Si todos los campos son válidos, calcular la fecha resultante
    if (!empty($fechaInicio) && !empty($diasSumar)) {
        $fechaResultante = sumarDiasHabiles($fechaInicio, $diasSumar, $diasNoSumar, $dias_inhabiles);
    }
}

// Función para sumar días excluyendo ciertos días de la semana y días inhabilitados
function sumarDiasHabiles($fechaInicio, $diasSumar, $diasNoSumar, $dias_inhabiles) {
    $fecha = strtotime($fechaInicio);
    $diasSumados = 0;

    while ($diasSumados < $diasSumar) {
        $fecha = strtotime('+1 day', $fecha);
        $diaSemana = date('N', $fecha);
        $diaMes = date('d-m-Y', $fecha);

        // Verificar si el día es un día inhabilitado
        if (isset($dias_inhabiles[$diaMes]) && $dias_inhabiles[$diaMes]) {
            continue;
        }

        // Verificar si el día es un día a excluir
        if (in_array($diaSemana, $diasNoSumar)) {
            continue;
        }

        $diasSumados++;
    }

    return date('d-m-Y', $fecha);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Suma de Fechas</title>
</head>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="fecha_inicio">Fecha de inicio:</label>
    <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fechaInicio; ?>" required><br><br>
    
    <label for="dias_sumar">Días a sumar:</label>
    <input type="number" id="dias_sumar" name="dias_sumar" min="1" value="<?php echo $diasSumar; ?>" required><br><br>

    <div>
    <button type="button" onclick="seleccionarDesmarcarTodas('dias_no_sumar')">Seleccionar/Desmarcar Todas</button>
        <button type="button" onclick="mostrarOcultar('dias_no_sumar')">Mostrar/Ocultar Días a Excluir</button><br><br>    

        <div id="dias_no_sumar" style="display:none">
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
        </div>
    </div>

    <div>
        <button type="button" onclick="seleccionarDesmarcarTodas('dias_inhabiles')">Seleccionar/Desmarcar Todas</button>
        <button type="button" onclick="mostrarOcultar('dias_inhabiles')">Mostrar/Ocultar Días Inhábiles</button><br><br>    

        <div id="dias_inhabiles" style="display:none">
            <label for="dias_no_sumar">Día inhabil:</label><br>
            <input type="checkbox" id="1_de_enero" name="dias_no_sumar[]" value="<?php echo $i_enero; ?>" <?php if(in_array($i_enero, $diasNoSumar)) echo "checked"; ?>>
            <label for="lunes">1 de enero</label><br>
            <input type="checkbox" id="primer_lunes_febrero" name="dias_no_sumar[]" value="<?php echo $i_febrero; ?>" <?php if(in_array($i_febrero, $diasNoSumar)) echo "checked"; ?>>
            <label for="martes">Primer lunes de febrero</label><br>
            <input type="checkbox" id="tercer_lunes_marzo" name="dias_no_sumar[]" value="<?php echo $iii_marzo; ?>" <?php if(in_array($iii_marzo, $diasNoSumar)) echo "checked"; ?>>
            <label for="martes">Tercer lunes de marzo</label><br>
            <input type="checkbox" id="1_de_mayo" name="dias_no_sumar[]" value="<?php echo $i_mayo; ?>" <?php if(in_array($i_mayo, $diasNoSumar)) echo "checked"; ?>>
            <label for="martes">1 de mayo</label><br>
            <input type="checkbox" id="5_de_mayo" name="dias_no_sumar[]" value="<?php echo $v_mayo; ?>" <?php if(in_array($v_mayo, $diasNoSumar)) echo "checked"; ?>>
            <label for="martes">5 de mayo</label><br>
            <input type="checkbox" id="16_de_septiembre" name="dias_no_sumar[]" value="<?php echo $xvi_septiembre; ?>" <?php if(in_array($xvi_septiembre, $diasNoSumar)) echo "checked"; ?>>
            <label for="martes">16 de septiembre</label><br>
            <input type="checkbox" id="tercer_lunes_noviembre" name="dias_no_sumar[]" value="<?php echo $iii_noviembre; ?>" <?php if(in_array($iii_noviembre, $diasNoSumar)) echo "checked"; ?>>
            <label for="martes">Tercer lunes de noviembre</label><br>
            <input type="checkbox" id="1_de_diciembre" name="dias_no_sumar[]" value="<?php echo $i_diciembre; ?>" <?php if(in_array($i_diciembre, $diasNoSumar)) echo "checked"; ?>>
            <label for="martes">1 de diciembre</label><br>
            <input type="checkbox" id="25_de_diciembre" name="dias_no_sumar[]" value="<?php echo $xxv_diciembre; ?>" <?php if(in_array($xxv_diciembre, $diasNoSumar)) echo "checked"; ?>>
            <label for="martes">25 de diciembre</label><br><br>
        </div>
    </div>

    <div>
        <input type="submit" value="Calcular Fecha Resultante">
        <input type="button" value="Limpiar Formulario" onclick="limpiarFormulario()">

        <?php
// Mostrar la fecha resultante si está definida
if (!empty($fechaResultante)) {
    echo "<p>La fecha resultante es: $fechaResultante</p>";
}
?>
    </div>
</form>

<script>
    function seleccionarDesmarcarTodas(id) {
        var checkboxes = document.querySelectorAll('#' + id + ' input[type=checkbox]');
        var check = checkboxes[0].checked;
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = !check;
        }
    }

    function mostrarOcultar(id) {
        var diasExcluir = document.getElementById(id);
        if (diasExcluir.style.display === 'none') {
            diasExcluir.style.display = 'block';
        } else {
            diasExcluir.style.display = 'none';
        }
    }

    function limpiarFormulario() {
        document.getElementById('fecha_inicio').value = '';
        document.getElementById('dias_sumar').value = '';
        var checkboxes = document.querySelectorAll('input[type=checkbox]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = false;
        }
    }
</script>

</body>
</html>
