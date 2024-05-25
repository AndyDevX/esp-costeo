<?php 

$fecha_inicio=$_POST["fecha_i"];
$dias=$_POST["numero_dias"];
$dias_b=$_POST["días"];

function sumarDiasHabiles($fechaInicial, $dias, $dias_b) {
    // Convertir la fecha inicial a un timestamp
    $fecha = strtotime($fechaInicial);
    
    // Iterar para sumar los días
    for ($i = 1; $i <= $dias; $i++) {
        // Sumar un día a la fecha actual
        $fecha = strtotime('+1 day', $fecha);
        
        // Verificar si la fecha resultante es sábado (6) o domingo (0)
        while (date('N', $fecha) >=$dias_b) {
            // Si es sábado o domingo, sumar un día adicional
            $fecha = strtotime('+1 day', $fecha);
        }
    }
    
    // Devolver la fecha resultante
    return date('Y-m-d', $fecha);
}

// Fecha inicial
$fechaInicial = $fecha_inicio;

// Sumar 10 días excluyendo sábados y domingos
$fechaFinal = sumarDiasHabiles($fechaInicial, $dias, $dias_b);

// Imprimir la fecha resultante
echo "La fecha después de sumar 10 días hábiles a partir de $fechaInicial es: $fechaFinal";
?>

?>