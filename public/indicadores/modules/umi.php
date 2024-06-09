<?php
    

    function getData($connection) {
        // Preparar la consulta
        $statement = $connection -> prepare("SELECT * FROM umi");

        if ($statement === false) {
            die("Error al preparar la búsqueda: ".$connection -> error);
        }

        // Ejecutar la consulta
        $statement -> execute();

        // Obtener resultados
        $result = $statement -> get_result();

        if ($result -> num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['año']."</td>
                    <td>".$row['umi']."</td>
                </tr>";
            }
        } else {
            echo "0 resultados";
        }

        // Cerrar la consulta y la conexión
        $statement->close();
        $connection->close();
    }
    
?>

<table class="custTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Año</th>
            <th>UMI</th>
        </tr>
    </thead>

    <tbody>
        <?php getData($connection); ?>
    </tbody>
</table>