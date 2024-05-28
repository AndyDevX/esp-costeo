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
    <button onclick="back('calculadoras/c_fiscal.php')">Fiscal</button>
    <button onclick="back('calculadoras/c_binario.php')">Binario</button>
    <button onclick="back('calculadoras/c_contable.php')">Contable</button>
    <button onclick="back('calculadoras/c_financiera.php')">Financiera</button>
    
    <hr>

    <button onclick="back('simuladores/costeo.php')">Simulador de costeo</button>
    <button onclick="back('simuladores/inversion.php')">Simulador de inversión</button>
</body>

<script src="../src/js/back.js"></script>

</html>
