<?php
    function getUMI($connection) {
        // Preparar la consulta
        $statement = $connection -> prepare("SELECT * FROM umi ORDER BY year DESC");

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


    function getUMA($connection) {
        // Preparar la consulta
        $statement = $connection -> prepare("SELECT * FROM uma ORDER BY year DESC");

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
                    <td class='columna2'>".$row['year']."</td>
                    <td class='columna3'>".$row['diario']."</td>
                    <td class='columna3'>".$row['mensual']."</td>
                    <td class='columna3'>".$row['anual']."</td>
                </tr>";
            }
        } else {
            echo "0 resultados";
        }

        // Cerrar la consulta y la conexión
        $statement->close();
        //$connection->close();
    }


    function getRetencionInteres($connection) {
        // Preparar la consulta
        $statement = $connection -> prepare("SELECT * FROM retencion_interes ORDER BY year DESC");

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
                    <td class='columna2'>".$row['year']."</td>
                    <td class='columna3'>".$row['tasa']."</td>
                </tr>";
            }
        } else {
            echo "0 resultados";
        }

        // Cerrar la consulta y la conexión
        $statement->close();
        //$connection->close();
    }

    function getINPC($connection) {
        $max = 1970;
        $id_year = 0;

        for ($i = $max; $i <= 2023; $i++) { // Iteramos años
            $id_year++;
            echo "<tr>";
                echo "<td>".$i."</td>";
            for ($j = 1; $j <= 12; $j++) { // Iteramos meses
                // Preparar la consulta
                $sql = "SELECT * FROM inpc WHERE id_year = ".$id_year." AND id_mes = ".$j;

                $results = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<td>".$row['inpc']."</td>";
                }
            }
            echo "</tr>";
        }
    }


    function getRecargos($connection) {
        $max = 1989;
        $id_year = 19;

        for ($i = $max; $i <= 2023; $i++) { // Iteramos años
            $id_year++;
            echo "<tr>";
                echo "<td>".$i."</td>";
            for ($j = 1; $j <= 12; $j++) { // Iteramos meses
                // Preparar la consulta
                $sql = "SELECT * FROM recargos WHERE id_year = ".$id_year." AND id_mes = ".$j;

                $results = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($results)) {
                    echo "<td>".$row['recargos']."</td>";
                }
            }
            echo "</tr>";
        }
    }

?>