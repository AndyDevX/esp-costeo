<?php
    include ("../src/php/session_check.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
</head>

<body>
    <button onclick="back('eric/c_fiscal.php')">Fiscal</button>
    <button onclick="back('eric/c_binario.php')">Binario</button>
    <button onclick="back('eric/c_contable.php')">Contable</button>
    <button onclick="back('eric/c_financiera.php')">Financiera</button>
    
    <hr>

    <button onclick="back('public/simuladores/costeo.php')">Simulador de costeo</button>
    <button onclick="back('public/simuladores/inversion.php')">Simulador de inversión</button>
</body>

<script src="src/js/back.js"></script>

</html>