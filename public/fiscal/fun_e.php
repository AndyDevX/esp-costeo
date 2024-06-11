<?php 
function nombre_ultimo_mes_bd(){

    include ('conexion.php');
    $busqueda_mes_final="SELECT id_mes  FROM inpc WHERE inpc IS NOT NULL ORDER BY id_inpc DESC LIMIT 1";
    $resultado_mes_final=mysqli_query ($conectar,$busqueda_mes_final); 
    while ($row=mysqli_fetch_assoc($resultado_mes_final))/*Esto es para buscar el nombre del último mes que se capturo */ 
    {
    $ultimo_mes= $row ["id_mes"];
    }
    
    $nombre_mes="SELECT mes FROM cat_mes WHERE id_mes=$ultimo_mes";
    $resultado_nombre_mes=mysqli_query ($conectar,$nombre_mes); 
    
    while ($row=mysqli_fetch_assoc($resultado_nombre_mes)) 
    {
    $nombre_ultimo_mes= $row ["mes"];
    }
    return $nombre_ultimo_mes;

}
?>

<?php 
function nombre_ultimo_año_bd(){

    include ('conexion.php');
    $busqueda_año_final="SELECT id_año  FROM inpc WHERE inpc IS NOT NULL ORDER BY id_inpc DESC LIMIT 1";
    $resultado_año_final=mysqli_query ($conectar,$busqueda_año_final); 
    while ($row=mysqli_fetch_assoc($resultado_año_final))/*Esto es para buscar el nombre del último mes que se capturo */ 
    {
    $ultimo_año= $row ["id_año"];
    }
    
    $nombre_año="SELECT año FROM cat_año WHERE id_año=$ultimo_año";
    $resultado_nombre_año=mysqli_query ($conectar,$nombre_año); 
    
    while ($row=mysqli_fetch_assoc($resultado_nombre_año)) 
    {
    $nombre_ultimo_año= $row ["año"];
    }
    return $nombre_ultimo_año;

}
?>

<?php
function inpc_historico($variable1, $variable2) {
    include('conexion.php');

    // Consulta preparada para evitar inyección de SQL
    $busqueda_inpc_h = "SELECT * FROM inpc E JOIN cat_año D ON E.id_año = D.id_año WHERE año = ? AND id_mes = ?";
    
    // Preparar la consulta
    $stmt = mysqli_prepare($conectar, $busqueda_inpc_h);
    // Vincular parámetros
    mysqli_stmt_bind_param($stmt, "ii", $variable1, $variable2);

    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);

    // Obtener resultado
    $resultado_inpc_h = mysqli_stmt_get_result($stmt);

    $inpc_anterior = null;

    // Obtener el valor de inpc si existe una fila que coincide
    while ($row = mysqli_fetch_assoc($resultado_inpc_h)) {
        $inpc_anterior = $row["inpc"];
    }

    // Cerrar la consulta preparada
    mysqli_stmt_close($stmt);

    return $inpc_anterior;
   
    
}
?>



<?php
function inpc_reciente($variable3, $variable4) {
    include('conexion.php');

    // Consulta preparada para evitar inyección de SQL
    $busqueda_inpc_a = "SELECT * FROM inpc E JOIN cat_año D ON E.id_año = D.id_año WHERE año = ? AND id_mes = ?";
    
    // Preparar la consulta
    $stmt = mysqli_prepare($conectar, $busqueda_inpc_a);
    // Vincular parámetros
    mysqli_stmt_bind_param($stmt, "ii", $variable3, $variable4);

    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);

    // Obtener resultado
    $resultado_inpc_a = mysqli_stmt_get_result($stmt);

    $inpc_actual = null;

    // Obtener el valor de inpc si existe una fila que coincide
    while ($row = mysqli_fetch_assoc($resultado_inpc_a)) {
        $inpc_actual = $row["inpc"];
    }

    // Cerrar la consulta preparada
    mysqli_stmt_close($stmt);

    return $inpc_actual;
   
    
}
?>


<?php
function fecha_inicial_recargo($año, $id_mes) {
    include('conexion.php');

    $busqueda_recargo = "SELECT id_recargos FROM recargos E 
                         JOIN cat_año D ON E.id_año = D.id_año 
                         WHERE año = ? AND id_mes = ?";
    
    $stmt = mysqli_prepare($conectar, $busqueda_recargo);
    mysqli_stmt_bind_param($stmt, "ii", $año, $id_mes);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_recargos);

    while (mysqli_stmt_fetch($stmt)) {
        $fecha_inicial_recargo = $id_recargos;
    }

    mysqli_stmt_close($stmt);

    return $fecha_inicial_recargo;
  

}

?>
<?php
function fecha_final_recargo($año, $id_mes) {
    include('conexion.php');

    $busqueda_recargo_f = "SELECT id_recargos FROM recargos E 
                           JOIN cat_año D ON E.id_año = D.id_año 
                           WHERE año = ? AND id_mes = ?";
    
    $stmt = mysqli_prepare($conectar,$busqueda_recargo_f);
    mysqli_stmt_bind_param($stmt, "ii", $año, $id_mes);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_recargos);

    while (mysqli_stmt_fetch($stmt)) {
        $fecha_final_recargo = $id_recargos;
    }
    mysqli_stmt_close($stmt);
    
    return $fecha_final_recargo; 
    
}


?>
<?php
function factor_recargo($fecha_inicial_recargo, $fecha_final_recargo) {
    include('conexion.php');

    $busqueda_factor = "SELECT SUM(recargos) AS suma_recargo FROM recargos WHERE id_recargos BETWEEN ? AND ?";
    
    $stmt = mysqli_prepare($conectar, $busqueda_factor);
    mysqli_stmt_bind_param($stmt, "ii", $fecha_inicial_recargo, $fecha_final_recargo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $factor_recargo);

    while (mysqli_stmt_fetch($stmt)) {
        // El resultado ya está en la variable $factor_recargo
    }

    mysqli_stmt_close($stmt);

    return $factor_recargo;
}
?>