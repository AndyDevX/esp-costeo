
<?php
include('fun_e.php');
include ('conexion.php');

// Obtener valores del formulario



$diaInicial = $_POST ['dia_inicial'];
$mesInicial = $_POST ['mes_inicial'];
$añoInicial = $_POST ['año_inicial'];
$diaFinal = $_POST ['dia_final'];
$mesFinal = $_POST ['mes_final'];
$añoFinal = $_POST ['año_final'];
$contribucionH= $_POST ['contribucion_h'];

$variable1= $añoInicial;
$variable2= $mesInicial;



if ($variable1 == 1970 && $variable2 == 1) {
    $variable2 = 1;
    $variable1 = 1970;

   }elseif ($variable2 == 1 && $variable1 > 1970) {
        $variable2 = 12;
        $variable1 = $variable1 - 1;
 } else {
        $variable2 = $variable2 - 1;
    }



$resultados=inpc_historico($variable1,$variable2);

 
$variable3=$añoFinal;
$variable4=$mesFinal;

if ($diaFinal < 10) {
    $variable4 = $variable4 - 2;
} else {
    $variable4 = $variable4 - 1;
}

if ($variable4 == 0 || $variable4 == -1) {
    $variable4 = ($variable4 == 0) ? 12 : 11;
    $variable3 = $variable3 - 1;
}

$resultados2=inpc_reciente($variable3,$variable4);



$año=$añoInicial;
$id_mes= $mesInicial;

if($año<1989){
    $año=1989;
    $id_mes=1;
}

$fechaInicialRecargo=fecha_inicial_recargo($año, $id_mes);



$año=$añoFinal;
$id_mes= $mesFinal;

if($diaFinal>17){
    $id_mes=$id_mes;

}else {
    $id_mes=$id_mes-1;

    if($id_mes==0){
        $id_mes=12;
        $año-=1;
    }else{ 
        if($id_mes==-1){
        $id_mes=11;
        $año--;
        }  
    }    

}

$fechaFinalRecargo=fecha_final_recargo($año, $id_mes);



$fecha_inicial_recargo= $fechaInicialRecargo;
$fecha_final_recargo= $fechaFinalRecargo;


$factorRecargo=factor_recargo($fecha_inicial_recargo, $fecha_final_recargo);

function truncar ($factorRecargo,$digitos)
{
$multiplicador = 100000;
$resultado = ($factorRecargo * $multiplicador) / $multiplicador;
return number_format($resultado, $digitos);
$factor = truncar($factorRecargor,4); 
}

$facturoDeActualización=truncar($resultados2 / $resultados,4);
if($facturoDeActualización < 1){
    $facturoDeActualización=1;
}



$actualizacion = number_format((($contribucionH *$facturoDeActualización ) - $contribucionH),2); 
          

$importe_recargo= number_format((($contribucionH + $actualizacion ) * $factorRecargo),2); 


$tabla = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .table-content {
        table-layout: auto;
        width: auto;
    }
</style>
<h3 class="mt-4 text-center">Resumen</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>Campos</th>
            <th>Valores</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td>IMPORTE DE LA CONTRIBUCIÓN HISTÓRICA</td>
            <td>' . "$" . number_format($contribucionH, 2) . '</td>
        </tr>
        <tr>
            <td><i class="fa-solid fa-plus"></i></td>
            <td>IMPORTE DE LA ACTUALIZACIÓN</td>
            <td>' . "$". $actualizacion . '</td>
        </tr>
        <tr>
            <td><i class="fa-solid fa-plus"></i></td>
            <td>IMPORTE DEL RECARGO</td>
            <td>' . "$" . $importe_recargo . '</td>
        </tr>
        <tr>
            <td><i class="fa-solid fa-equals"></i></td>
            <td>IMPORTE TOTAL</td>
            <td>' . "$" . number_format($importe_total = $contribucionH + $actualizacion + $importe_recargo, 0) . '</td>
        </tr>
    </tbody>
</table>';

// Imprimir la tabla
echo $tabla;

?>
<?php



?>