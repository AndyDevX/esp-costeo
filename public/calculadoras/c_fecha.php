<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Fecha</title>
</head>
<body>

<form method="POST" action="c_fecha_2.php">
    <label for="fecha">Fecha de inicio:</label>
    <input type="date" id="fecha" name="fecha_i">
<div>
<label>Selecciona los días de la semana:</label><br>
    <input type="checkbox" id="lunes" name="dias[]" value="lunes">
    <label for="lunes">Lunes</label><br>
    <input type="checkbox" id="martes" name="dias[]" value="martes">
    <label for="martes">Martes</label><br>
    <input type="checkbox" id="miercoles" name="dias[]" value="miércoles">
    <label for="miercoles">Miércoles</label><br>
    <input type="checkbox" id="jueves" name="dias[]" value="jueves">
    <label for="jueves">Jueves</label><br>
    <input type="checkbox" id="viernes" name="dias[]" value="viernes">
    <label for="viernes">Viernes</label><br>
    <input type="checkbox" id="sabado" name="dias[]" value="sábado">
    <label for="sabado">Sábado</label><br>
    <input type="checkbox" id="domingo" name="dias[]" value="domingo">
    <label for="domingo">Domingo</label><br>
</div>

    <label for="numero">Número de días:</label>
    <input type="number" id="numero" name="numero_dias" min="0" required>
<div>
        
</div>
    <input type="submit" value="Enviar">
</form>

</body>
</html>