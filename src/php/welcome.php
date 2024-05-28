<?php
    include ("session_check.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido</title>
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Has iniciado sesión exitosamente.</p>

    <a href="../../public/menu.php">Menú</a>
    <br>
    <br>
    <a href="logout.php">Cerrar
