<?php
    function getUMI($connection) {
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
                    <td class='columna1'>".$row['id']."</td>
                    <td class='columna2'>".$row['year']."</td>
                    <td class='columna3'>".$row['umi']."</td>
                </tr>";
            }
        } else {
            echo "0 resultados";
        }

        // Cerrar la consulta y la conexión
        $statement->close();
        //$connection->close();
    }  
?>