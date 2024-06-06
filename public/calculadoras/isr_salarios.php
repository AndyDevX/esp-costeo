<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISR Ingresos por sueldos </title>
</head>
<body>
    <h1>ISR Ingresos por sueldos </h1>
    <form method="POST" action="">
        <label for="valor1">Ingresos mensuales:</label>
        <input type="number" id="valor1" name="valor1" step="0.01" required><br><br>
        
        <label for="valor2">Ingresos exento:</label>
        <input type="number" id="valor2" name="valor2" step="0.01" required><br><br>
        
        <label for="periodo">Periodo:</label>
        <select id="periodo" name="periodo" required>
            <option value="dia">Día</option>
            <option value="semana">Semana</option>
            <option value="catorcena">Catorcena</option>
            <option value="quincena">Quincena</option>
            <option value="mes">Mes</option>
       <!--<option value="trimestre">Trimestre</option>
            <option value="cuatrimestre">Cuatrimestre</option>
            <option value="semestre">Semestre</option>
            <option value="anual">Anual</option>-->
        </select><br><br>

        <input type="submit" value="Enviar">
    </form>

    <?php
if (isset($_POST['valor1']) && isset($_POST['valor2'])&& isset($_POST['periodo'])) {
    // Obtener valores del formulario
    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];
    $periodo = $_POST['periodo'];

    // Calcular base gravable
    $base_gravable = $valor1 - $valor2;

    if($periodo =='dia'){
        $base_gravable_con=$base_gravable*30.4;}
    elseif($periodo =='semana'){
        $base_gravable_con=(($base_gravable)/7)*30.4;}
    elseif($periodo =='catorcena'){
        $base_gravable_con=($base_gravable/14)*30.4;}
    elseif($periodo =='quincena'){
        $base_gravable_con=(($base_gravable)/15)*30.4;}
    else {
    $base_gravable_con=$base_gravable;
}



    // Imprimir valores recibidos y base gravable
    echo "<h2>Valores recibidos:</h2>";
    echo "Ingresos mensuales: $valor1 <br>";
    echo "Ingresos exento: $valor2 <br>";
    echo "Base Gravable: $base_gravable <br><br>";
    echo "Periodo: " . htmlspecialchars($periodo) . "<br>";

    // Conectar a la base de datos
    include('conexion.php');

             if ($conectar->connect_error) {
        die("Error de conexión: " . $conectar->connect_error);
    }

    // Consulta a la base de datos usando base gravable
    $busqueda_id = "SELECT id FROM tarifa WHERE ? BETWEEN limite_inferior AND limite_superior";

    $stmt = $conectar->prepare($busqueda_id);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conectar->error);
    }

    $stmt->bind_param("d", $base_gravable_con);
    $stmt->execute();
    $stmt->bind_result($id);

    $resultado = "";
    while ($stmt->fetch()) {
        $resultado .= $id;
    }

    if (empty($resultado)) {
        $resultado = "No se encontraron resultados.";
    }

    //echo $resultado;

    $stmt->close();
    $conectar->close();

      
        include('conexion.php');
if ($conectar->connect_error) {
    die("Error de conexión: " . $conectar->connect_error);
}

// Consulta a la base de datos usando base gravable
$limite_inferior = "SELECT limite_inferior FROM tarifa WHERE id =?";

$stmt = $conectar->prepare($limite_inferior);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conectar->error);
}

$stmt->bind_param("d", $resultado);
$stmt->execute();
$stmt->bind_result($li);

$r_l_i = "";
while ($stmt->fetch()) {
    $r_l_i .=  $li;
}

if (empty($r_l_i)) {
    $r_l_i = "No se encontraron resultados.";
}

if ($periodo == 'dia') {
    $r_l_i_con = $r_l_i / 30.4;
} elseif ($periodo == 'semana') {
    $r_l_i_con = ($r_l_i / 30.4) * 7;
} elseif ($periodo == 'catorcena') {
    $r_l_i_con = ($r_l_i / 30.4) * 14;
} elseif ($periodo == 'quincena') {
    $r_l_i_con = ($r_l_i / 30.4) * 15;
} else {
    $r_l_i_con = $r_l_i;
}
//echo $r_l_i;

$stmt->close();
$conectar->close();

include('conexion.php');
if ($conectar->connect_error) {
    die("Error de conexión: " . $conectar->connect_error);
}

// Consulta a la base de datos para identificar la tasa
$tasa = "SELECT por_ciento FROM tarifa WHERE id =?";

$stmt = $conectar->prepare($tasa);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conectar->error);
}

$stmt->bind_param("d", $resultado);
$stmt->execute();
$stmt->bind_result($tasa1);

$r_tasa = "";
while ($stmt->fetch()) {
    $r_tasa .=  $tasa1;
}

if (empty($r_tasa)) {
    $r_tasa = "No se encontraron resultados.";
}

//echo $r_tasa;

$stmt->close();
$conectar->close();

include('conexion.php');
if ($conectar->connect_error) {
    die("Error de conexión: " . $conectar->connect_error);
}

// Consulta a la base de datos para encontrar la cuota fija
$cuota_fija = "SELECT cuota_fija FROM tarifa WHERE id =?";

$stmt = $conectar->prepare($cuota_fija);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conectar->error);
}

$stmt->bind_param("d", $resultado);
$stmt->execute();
$stmt->bind_result($cuotaf);

$r_cuota_fija = "";
while ($stmt->fetch()) {
    $r_cuota_fija .=  $cuotaf;
}

if (empty($r_cuota_fija)) {
    $r_cuota_fija = "No se encontraron resultados.";
}

if($periodo=='dia'){
    $r_cuota_fija_con=$r_cuota_fija/30.4;}
    elseif($periodo =='semana'){
        $r_cuota_fija_con=number_format(($r_cuota_fija/30.4),2, '.', ',')*7;}
    elseif($periodo =='catorcena'){
            $r_cuota_fija_con=number_format(($r_cuota_fija/30.4),2, '.', ',')*14;}
    elseif($periodo =='quincena'){
            $r_cuota_fija_con=number_format(($r_cuota_fija/30.4),2, '.', ',')*15;} 
else {
    $r_cuota_fija_con=$r_cuota_fija;
}
//echo $r_cuota_fija;

$stmt->close();
$conectar->close();
}
?>


    <?php if (isset($resultado)): 

        $ex_li=$base_gravable - $r_l_i_con;
        $impuesto_marginal= $ex_li * $r_tasa;
        $impuesto=$r_cuota_fija_con+$impuesto_marginal;
        $tasa_1=$r_tasa*100;
      
    
        $subsidio_empleo = 0;
if ($periodo == 'dia') {
    $limite_subsidio = 9081 / 30.4;
    if ($base_gravable <= $limite_subsidio) {
        $subsidio_empleo = 12.83;
    }
} elseif ($periodo == 'semana') {
    $limite_subsidio = (9081 / 30.4) * 7;
    if ($base_gravable <= $limite_subsidio) {
        $subsidio_empleo = 89.8;
    }
} elseif ($periodo == 'catorcena') {
    $limite_subsidio = (9081 / 30.4) * 14;
    if ($base_gravable <= $limite_subsidio) {
        $subsidio_empleo = 179.61;
    }
} elseif ($periodo == 'quincena') {
    $limite_subsidio = (9081 / 30.4) * 15;
    if ($base_gravable <= $limite_subsidio) {
        $subsidio_empleo = 192.43;
    }
} elseif ($periodo == 'mes') {
    $limite_subsidio = 9081;
    if ($base_gravable <= $limite_subsidio) {
        $subsidio_empleo = 390;
    }
}
        


if(($impuesto-$subsidio_empleo)<0){
    $isr=0;}
else {
    $isr=$impuesto-$subsidio_empleo;
}
        

        ?>

        <h2>Resultados de la base de datos:</h2>

        <label for="resultado">Base gravable:</label>
        <input type="text" id="resultado" value="<?php echo number_format($base_gravable, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">Límite Inferior:</label>
        <input type="text" id="resultado" value="<?php echo number_format($r_l_i_con, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">Excedente sobre Limite inferior:</label>
        <input type="text" id="resultado" value="<?php echo number_format($ex_li, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">Tasa %:</label>
        <input type="text" id="resultado" value="<?php echo number_format($tasa_1,2, '.', ','). '%'; ?>" readonly><br><br>
        <label for="resultado">Impuesto Marginal:</label>
        <input type="text" id="resultado" value="<?php echo number_format($impuesto_marginal, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">Cuota Fija:</label>
        <input type="text" id="resultado" value="<?php echo number_format($r_cuota_fija_con, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">Impuesto ISR:</label>
        <input type="text" id="resultado" value="<?php echo number_format($impuesto, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">Subsidio al empleo:</label>
        <input type="text" id="resultado" value="<?php echo number_format($subsidio_empleo, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">ISR a Retener:</label>
        <input type="text" id="resultado" value="<?php echo number_format($isr, 2, '.', ','); ?>" readonly><br><br>


    <?php endif; ?>

    <!-- Botones para limpiar y regresar -->
    <button onclick="document.querySelector('form').reset();">Limpiar</button>
    <button onclick="window.history.back();">Regresar</button>
</body>
</html>