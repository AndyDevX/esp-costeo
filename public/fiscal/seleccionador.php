<!DOCTYPE html>
<html>
<head>
    <title>Formulario con Select y Switch</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css"> <!-- 1 paso --->
</head>


<body>

<div class="bg-image d-flex justify-content-center align-items-center"> 
    <div class="custom-container text-center">
    <div class="content">
        
      <form method="post" action="">
    <label class = "h3 mb-3"for="opcion">Elige una opción:</label>
    <select name="opcion" id="opcion">
        <option value="opcion1">Actualizaciones y Recargos</option>
        <option value="opcion2">ISR sueldos y salarios</option>
        <option value="opcion3">ISR arrendamiento</option>
        <option value="opcion4">ISR actividad empresarial regímen general</option>
    </select>
    <button class="btn btn-primary mt-2" type="submit" value="Enviar"> Enviar </button> 
    
   
</form>
  
   <button class="btn btn-primary mt-2"  onclick="window.location.href='../menu.php'">Volver</button>
    </div>
    </div>
</div> 

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["opcion"])) {
    
    $opcionSeleccionada = $_POST["opcion"];
    
    switch ($opcionSeleccionada) {
        case "opcion1":
            header("Location: ac_rec_2ok.php");
            exit;
            break;
        case "opcion2":
            header("Location: isr_salarios.php");
            exit;
            break;
        case "opcion3":
            header("Location: isr_arrendamiento.php");
            exit;
            break;
        case "opcion4":
            header("Location: isr_actividad_e_g.php");
            exit;
            break;
        //default:
          //  echo "Opción no válida";
            // Aquí puedes añadir el código para manejar una opción no válida
            //break;
    }
}
?>

</body>
</html>