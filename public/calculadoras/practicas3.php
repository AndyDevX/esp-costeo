
<!DO<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISR Ingresos por arrendamiento</title>
    <script>
        function handleInput() {
            const ingresoAPF = document.getElementById('ingreso_a_pf');
            const ingresoAPM = document.getElementById('ingreso_a_pm');
            const ingresoSPF = document.getElementById('ingreso_s_pf');
            const ingresoSPM = document.getElementById('ingreso_s_pm');
            const pagoRentas = document.getElementById('p_r');
            const deduccionOpcional = document.getElementById('ciega').value;

            const camposArrendamiento = [ingresoAPF, ingresoAPM];
            const camposSubarrendamiento = [ingresoSPF, ingresoSPM, pagoRentas];
            const camposDeducciones = [
                document.getElementById('i_p'),
                document.getElementById('i_l'),
                document.getElementById('g_m'),
                document.getElementById('i_r'),
                document.getElementById('s_c'),
                document.getElementById('p_s'),
                document.getElementById('i_c')
            ];

            // Resetear los campos a habilitados y requeridos
            camposArrendamiento.forEach(campo => {
                campo.disabled = false;
                campo.required = true;
            });
            camposSubarrendamiento.forEach(campo => {
                campo.disabled = false;
                campo.required = true;
            });
            camposDeducciones.forEach(campo => {
                campo.disabled = false;
                campo.required = true;
            });
            pagoRentas.disabled = true;
            pagoRentas.required = false;

            // Logica de habilitar/deshabilitar campos
            if (ingresoAPF.value || ingresoAPM.value) {
                camposSubarrendamiento.forEach(campo => {
                    campo.disabled = true;
                    campo.required = false;
                });
                if (deduccionOpcional === 'si') {
                    camposDeducciones.forEach(campo => {
                        campo.disabled = true;
                        campo.required = false;
                    });
                }
                document.getElementById('ciega').disabled = false;
            } else if (ingresoSPF.value || ingresoSPM.value) {
                camposArrendamiento.forEach(campo => {
                    campo.disabled = true;
                    campo.required = false;
                });
                camposDeducciones.forEach(campo => {
                    campo.disabled = true;
                    campo.required = false;
                });
                pagoRentas.disabled = false;
                pagoRentas.required = true;
                document.getElementById('ciega').disabled = true;
            }

            if (deduccionOpcional === 'si' && !(ingresoSPF.value || ingresoSPM.value)) {
                camposDeducciones.forEach(campo => {
                    campo.disabled = true;
                    campo.required = false;
                });
            }
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            const inputs = document.querySelectorAll('input[type="number"], select');
            inputs.forEach(input => {
                input.addEventListener('input', handleInput);
                input.addEventListener('change', handleInput); // For select element
            });
            handleInput(); // Para inicializar la lógica al cargar la página
        });
    </script>
</head>
<body>
    <h1>ISR Ingresos por arrendamiento</h1>
    <h3>Ingresos</h3>
    <form method="POST" action="">
        <label for="ingreso1">Ingresos por arrendamiento mensuales PF:</label>
        <input type="number" id="ingreso_a_pf" name="valor1" step="0.01"><br><br>
        
        <label for="ingreso2">Ingresos por arrendamiento mensuales PM:</label>
        <input type="number" id="ingreso_a_pm" name="valor2" step="0.01"><br><br>
        
        <label for="ingreso3">Ingresos por subarrendamiento mensuales PF:</label>
        <input type="number" id="ingreso_s_pf" name="valor3" step="0.01"><br><br>
        
        <label for="ingreso4">Ingresos por subarrendamiento mensuales PM:</label>
        <input type="number" id="ingreso_s_pm" name="valor4" step="0.01"><br><br>
    
        <h3>Deducciones</h3>
        <label for="opcional">Deducción opcional (deducción ciega):</label>
        <select id="ciega" name="opcional" required>
            <option value="si">Sí</option>
            <option value="no">No</option>
        </select><br><br>

        <label for="deduccion5">Impuesto predial:</label>
        <input type="number" id="i_p" name="valor5" step="0.01"><br><br> 
        
        <label for="deduccion6">Impuesto locales:</label>
        <input type="number" id="i_l" name="valor6" step="0.01"><br><br>  
        
        <label for="deduccion7">Gastos de mantenimiento:</label>
        <input type="number" id="g_m" name="valor7" step="0.01"><br><br>  
        
        <label for="deduccion8">Intereses reales pagados:</label>
        <input type="number" id="i_r" name="valor8" step="0.01"><br><br>
        
        <label for="deduccion9">Salarios, comisiones y honorarios (incluyendo contribuciones):</label>
        <input type="number" id="s_c" name="valor9" step="0.01"><br><br>  
        
        <label for="deduccion10">Importe de las primas de seguros:</label>
        <input type="number" id="p_s" name="valor10" step="0.01"><br><br>  
        
        <label for="deduccion11">Inversiones en construcción, incluyendo adiciones y mejoras:</label>
        <input type="number" id="i_c" name="valor11" step="0.01"><br><br>  
        
        <label for="deduccion12">Pago de las rentas (en caso de subarrendamiento):</label>
        <input type="number" id="p_r" name="valor12" step="0.01"><br><br>
        
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener valores del formulario con valores por defecto en caso de que no estén presentes
        $valor1 = isset($_POST['valor1']) ? $_POST['valor1'] : 0;
        $valor2 = isset($_POST['valor2']) ? $_POST['valor2'] : 0;
        $valor3 = isset($_POST['valor3']) ? $_POST['valor3'] : 0;
        $valor4 = isset($_POST['valor4']) ? $_POST['valor4'] : 0;
        $valor5 = isset($_POST['valor5']) ? $_POST['valor5'] : 0;
        $valor6 = isset($_POST['valor6']) ? $_POST['valor6'] : 0;
        $valor7 = isset($_POST['valor7']) ? $_POST['valor7'] : 0;
        $valor8 = isset($_POST['valor8']) ? $_POST['valor8'] : 0;
        $valor9 = isset($_POST['valor9']) ? $_POST['valor9'] : 0;
        $valor10 = isset($_POST['valor10']) ? $_POST['valor10'] : 0;
        $valor11 = isset($_POST['valor11']) ? $_POST['valor11'] : 0;
        $valor12 = isset($_POST['valor12']) ? $_POST['valor12'] : 0;
        $opcional = isset($_POST['opcional']) ? $_POST['opcional'] : 'no';

        echo "<h2>Valores recibidos:</h2>";
        echo ": $valor1 <br>";
        echo ": $valor2 <br>";
        echo ": $valor3 <br>";
        echo ": $valor4 <br>";
        echo ": $valor5 <br>";
        echo ": $valor6 <br>";
        echo ": $valor7 <br>";
        echo ": $valor8 <br>";
        echo ": $valor9 <br>";
        echo ": $valor10 <br>";
        echo ": $valor11 <br>";
        echo ": $valor12 <br>";
        echo ": $opcional <br>";

        // Calcular base gravable
        $ingreso_arrendamiento = $valor1 + $valor2;
        $ingreso_sub = $valor3 + $valor4;
        $deduccion_gene = $valor5 + $valor6 + $valor7 + $valor8 + $valor9 + $valor10 + $valor11;
        $deduccion_op = $opcional === 'si' ? $ingreso_arrendamiento * 0.35 : 0;
        $deduccion_sub = $valor12;
        $ingreso_mes = $ingreso_arrendamiento + $ingreso_sub;
        $deduccion_mes = $deduccion_gene + $deduccion_op + $deduccion_sub;
        $base_gravable_m = $ingreso_mes - $deduccion_mes;
        $base_gravable_m = floatval($base_gravable_m);

        echo ": $base_gravable_m <br>";

        include('conexion.php');

        if ($conectar->connect_error) {
            die("Error de conexión: " . $conectar->connect_error);
        }

        // Consulta a la base de datos para identificar el id
        $busqueda_id = "SELECT id FROM tarifa WHERE ? BETWEEN limite_inferior AND limite_superior";

        $stmt = $conectar->prepare($busqueda_id);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conectar->error);
        }

        $stmt->bind_param("i", $base_gravable_m);
        $stmt->execute();
        $stmt->bind_result($id);

        $resultado = "";
        while ($stmt->fetch()) {
            $resultado .= $id;
        }

        if (empty($resultado)) {
            $resultado = "No se encontraron resultados.";
        }

        $stmt->close();
        $conectar->close();

        // Consulta a la base de datos usando para identificar el LI
        include('conexion.php');
        if ($conectar->connect_error) {
            die("Error de conexión: " . $conectar->connect_error);
        }

        $limite_inferior = "SELECT limite_inferior FROM tarifa WHERE id = ?";

        $stmt = $conectar->prepare($limite_inferior);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conectar->error);
        }
// $stmt->bind_param("d", $resultado) la "d" indica float y la "i" entero
        $stmt->bind_param("d", $resultado);
        $stmt->execute();
        $stmt->bind_result($li);

        $r_l_i = "";
        while ($stmt->fetch()) {
            $r_l_i .= $li;
        }

        if (empty($r_l_i)) {
            $r_l_i = "No se encontraron resultados.";
        }

        $stmt->close();
        $conectar->close();

        // Consulta a la base de datos para identificar la tasa
        include('conexion.php');
        if ($conectar->connect_error) {
            die("Error de conexión: " . $conectar->connect_error);
        }

        $tasa = "SELECT por_ciento FROM tarifa WHERE id = ?";

        $stmt = $conectar->prepare($tasa);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conectar->error);
        }

        $stmt->bind_param("d", $resultado);
        $stmt->execute();
        $stmt->bind_result($tasa1);

        $r_tasa = "";
        while ($stmt->fetch()) {
            $r_tasa .= $tasa1;
        }

        if (empty($r_tasa)) {
            $r_tasa = "No se encontraron resultados.";
        }

        $stmt->close();
        $conectar->close();

        // Consulta a la base de datos para encontrar la cuota fija
        include('conexion.php');
        if ($conectar->connect_error) {
            die("Error de conexión: " . $conectar->connect_error);
        }

        $cuota_fija = "SELECT cuota_fija FROM tarifa WHERE id = ?";

        $stmt = $conectar->prepare($cuota_fija);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conectar->error);
        }

        $stmt->bind_param("d", $resultado);
        $stmt->execute();
        $stmt->bind_result($cuotaf);

        $r_cuota_fija = "";
        while ($stmt->fetch()) {
            $r_cuota_fija .= $cuotaf;
        }

        if (empty($r_cuota_fija)) {
            $r_cuota_fija = "No se encontraron resultados.";
        }

        $stmt->close();
        $conectar->close();
        echo ": $resultado <br>";
        echo ": $r_l_i <br>";
        // Calcular impuesto
        $ex_li = $base_gravable_m - $r_l_i;
        $impuesto_marginal = $ex_li * ($r_tasa);
        $retención_isr = ($valor2+$valor4)* .10; 
        $impuesto = $r_cuota_fija + $impuesto_marginal-$retención_isr;
    ?>
        <h2>Resultados de la base de datos:</h2>

        <label for="resultado1">Base gravable:</label>
        <input type="text" id="resultado1" value="<?php echo number_format($base_gravable_m, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado2">Límite Inferior:</label>
        <input type="text" id="resultado2" value="<?php echo number_format($r_l_i, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado3">Excedente sobre Limite inferior:</label>
        <input type="text" id="resultado3" value="<?php echo number_format($ex_li, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado4">Tasa %:</label>
        <input type="text" id="resultado4" value="<?php echo number_format(($r_tasa*100), 2, '.', ','). '%'; ?>" readonly><br><br>
        <label for="resultado5">Impuesto Marginal:</label>
        <input type="text" id="resultado5" value="<?php echo number_format($impuesto_marginal, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado6">Cuota Fija:</label>
        <input type="text" id="resultado6" value="<?php echo number_format($r_cuota_fija, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado7">Impuesto ISR:</label>
        <input type="text" id="resultado7" value="<?php echo number_format($impuesto, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado8">Retención de ISR mensual:</label>
        <input type="text" id="resultado8" value="<?php echo number_format($retención_isr, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado9">Pago provisional del mes:</label>
        <input type="text" id="resultado9" value="<?php echo number_format($impuesto, 2, '.', ','); ?>" readonly><br><br>

    <?php
    }
    ?>

    <!-- Botones para limpiar y regresar -->
    <button onclick="document.querySelector('form').reset();">Limpiar</button>
    <button onclick="window.history.back();">Regresar</button>
</body>
</html>
