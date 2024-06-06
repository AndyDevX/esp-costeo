<!DOCTYPE html>
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

            if (ingresoAPF.value || ingresoAPM.value) {
                camposSubarrendamiento.forEach(campo => campo.disabled = true);
                camposDeducciones.forEach(campo => campo.disabled = false);
                document.getElementById('ciega').disabled = false;
            } else if (ingresoSPF.value || ingresoSPM.value) {
                camposArrendamiento.forEach(campo => campo.disabled = true);
                camposDeducciones.forEach(campo => campo.disabled = true);
                pagoRentas.disabled = false;
                document.getElementById('ciega').disabled = true;
            } else {
                camposSubarrendamiento.forEach(campo => campo.disabled = false);
                camposArrendamiento.forEach(campo => campo.disabled = false);
                camposDeducciones.forEach(campo => campo.disabled = false);
                pagoRentas.disabled = true;
                document.getElementById('ciega').disabled = false;
            }

            if (deduccionOpcional === 'si') {
                camposDeducciones.forEach(campo => campo.disabled = true);
            } else {
                if (!(ingresoSPF.value || ingresoSPM.value)) {
                    camposDeducciones.forEach(campo => campo.disabled = false);
                }
            }
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            const inputs = document.querySelectorAll('input[type="number"], select');
            inputs.forEach(input => {
                input.addEventListener('input', handleInput);
                input.addEventListener('change', handleInput); // For select element
            });
        });
    </script>
</head>
<body>
    <h1>ISR Ingresos por arrendamiento</h1>
    <h3>Ingresos</h3>
    <form method="POST" action="">
        <label for="ingreso1">Ingresos por arrendamiento mensuales PF:</label>
        <input type="number" id="ingreso_a_pf" name="valor1" step="0.01" required><br><br>
        
        <label for="ingreso2">Ingresos por arrendamiento mensuales PM:</label>
        <input type="number" id="ingreso_a_pm" name="valor2" step="0.01" required><br><br>
        
        <label for="ingreso3">Ingresos por subarrendamiento mensuales PF:</label>
        <input type="number" id="ingreso_s_pf" name="valor3" step="0.01" required><br><br>
        
        <label for="ingreso4">Ingresos por subarrendamiento mensuales PM:</label>
        <input type="number" id="ingreso_s_pm" name="valor4" step="0.01" required><br><br>
    
        <h3>Deducciones</h3>
        <label for="opcional">Deducción opcional (deducción ciega):</label>
        <select id="ciega" name="opcional" required>
            <option value="si">Sí</option>
            <option value="no">No</option>
        </select><br><br>

        <label for="deduccion5">Impuesto predial:</label>
        <input type="number" id="i_p" name="valor5" step="0.01" required><br><br> 
        
        <label for="deduccion6">Impuesto locales:</label>
        <input type="number" id="i_l" name="valor6" step="0.01" required><br><br>  
        
        <label for="deduccion7">Gastos de mantenimiento:</label>
        <input type="number" id="g_m" name="valor7" step="0.01" required><br><br>  
        
        <label for="deduccion8">Intereses reales pagados:</label>
        <input type="number" id="i_r" name="valor8" step="0.01" required><br><br>
        
        <label for="deduccion9">Salarios, comisiones y honorarios (incluyendo contribuciones):</label>
        <input type="number" id="s_c" name="valor9" step="0.01" required><br><br>  
        
        <label for="deduccion10">Importe de las primas de seguros:</label>
        <input type="number" id="p_s" name="valor10" step="0.01" required><br><br>  
        
        <label for="deduccion11">Inversiones en construcción, incluyendo adiciones y mejoras:</label>
        <input type="number" id="i_c" name="valor11" step="0.01" required><br><br>  
        
        <label for="deduccion12">Pago de las rentas (en caso de subarrendamiento):</label>
        <input type="number" id="p_r" name="valor12" step="0.01" required><br><br>
        
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si todos los valores se han recibido correctamente
        $requiredFields = ['valor1', 'valor2', 'valor3', 'valor4', 'valor5', 'valor6', 'valor7', 'valor8', 'valor9', 'valor10', 'valor11', 'valor12', 'opcional'];
        $allValuesSet = true;
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field])) {
                $allValuesSet = false;
                break;
            }
        }
    }
        if ($allValuesSet) {
            // Obtener valores del formulario
            $valor1 = $_POST['valor1'];
            $valor2 = $_POST['valor2'];
            $valor3 = $_POST['valor3'];
            $valor4 = $_POST['valor4'];
            $valor5 = $_POST['valor5'];
            $valor6 = $_POST['valor6'];
            $valor7 = $_POST['valor7'];
            $valor8 = $_POST['valor8'];
            $valor9 = $_POST['valor9'];
            $valor10 = $_POST['valor10'];
            $valor11 = $_POST['valor11'];
            $valor12 = $_POST['valor12'];
            $opcional = $_POST['opcional'];

        // Calcular base gravable
        $ingreso_arrendamiento = $valor1 + $valor2;
        $ingreso_sub = $valor3 + $valor4;
        $deduccion_gene = $valor5 + $valor6 + $valor7 + $valor8 + $valor9 + $valor10 + $valor11;
        $deduccion_op = $opcional === 'si' ? $valor5 + ($ingreso_arrendamiento * 0.35) : 0;
        $deduccion_sub = $valor12;
        $ingreso_mes = $ingreso_arrendamiento + $ingreso_sub;
        $deduccion_mes = $deduccion_gene + $deduccion_op + $deduccion_sub;
        $base_gravable_m = $ingreso_mes - $deduccion_mes;

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

        $stmt->bind_param("d", $base_gravable_m);
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

        // Calcular impuesto
        $ex_li = $base_gravable_m - $r_l_i;
        $impuesto_marginal = $ex_li * ($r_tasa / 100);
        $impuesto = $r_cuota_fija + $impuesto_marginal;
        $retención_isr = 0; // Ajusta este valor según sea necesario

        ?>

        <h2>Resultados de la base de datos:</h2>

        <label for="resultado">Base gravable:</label>
        <input type="text" id="resultado" value="<?php echo number_format($base_gravable_m, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">Límite Inferior:</label>
        <input type="text" id="resultado" value="<?php echo number_format($r_l_i, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">Excedente sobre Limite inferior:</label>
        <input type="text" id="resultado" value="<?php echo number_format($ex_li, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">Tasa %:</label>
        <input type="text" id="resultado" value="<?php echo number_format($r_tasa, 2, '.', ','). '%'; ?>" readonly><br><br>
        <label for="resultado">Impuesto Marginal:</label>
        <input type="text" id="resultado" value="<?php echo number_format($impuesto_marginal, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">Cuota Fija:</label>
        <input type="text" id="resultado" value="<?php echo number_format($r_cuota_fija, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">Impuesto ISR:</label>
        <input type="text" id="resultado" value="<?php echo number_format($impuesto, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">Retención de ISR mensual:</label>
        <input type="text" id="resultado" value="<?php echo number_format($retención_isr, 2, '.', ','); ?>" readonly><br><br>
        <label for="resultado">Pago provisional del mes:</label>
        <input type="text" id="resultado" value="<?php echo number_format($impuesto, 2, '.', ','); ?>" readonly><br><br>

        <?php
    }
    ?>

    <!-- Botones para limpiar y regresar -->
    <button onclick="document.querySelector('form').reset();">Limpiar</button>
    <button onclick="window.history.back();">Regresar</button>
</body>
</html>
