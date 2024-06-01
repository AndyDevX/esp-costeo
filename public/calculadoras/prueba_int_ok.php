<!DOCTYPE html>
<html>
<head>
    <title>Formulario con Select y Switch</title>
</head>
<body>

<form method="post" action="">
    <label for="opcion">Elige una opción:</label>
    <select name="opcion" id="opcion">
        <option value="opcion1">Actualizaciones y Recargos</option>
        <option value="opcion2">ISR sueldos y salarios (mensual)</option>
        <option value="opcion3">Opción 3</option>
    </select>
    <input type="submit" value="Enviar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opcionSeleccionada = $_POST["opcion"];
    
    switch ($opcionSeleccionada) {
        case "opcion1":
         include("ac_rec_2ok.php");
            
            break;
        case "opcion2":
            include("isr_salarios.php");
            break;
        case "opcion3":
            echo "Has seleccionado la Opción 3";
            // Aquí puedes añadir el código específico para la Opción 3
            break;
        default:
            echo "Opción no válida";
            // Aquí puedes añadir el código para manejar una opción no válida
            break;
    }
}
?>

</body>
</html>

