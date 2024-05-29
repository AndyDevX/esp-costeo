<?php
    include ("../../src/php/session_check.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Web</title>
</head>
<body>
    <label for="selectBox"></label>
    <select id="selectBox">
        <option value="0">Selecciona una opción:</option>
        <option value="1">Opción 1</option>
        <option value="2">Opción 2</option>
        <option value="3">Opción 3</option>
    </select>

    <div id="formContainer"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const selectBox = document.getElementById("selectBox");
            const formContainer = document.getElementById("formContainer");

            selectBox.addEventListener("change", function () {
                const selectedOption = selectBox.value;
                formContainer.innerHTML = ""; // Limpia el contenido anterior del contenedor de formulario

                if (selectedOption === "1") {
                   "<?php include ("ac_rec_2ok.php");?>";
                } else if (selectedOption === "2") {
                    createForm(2);
                } else if (selectedOption === "3") {
                    createForm(4);
                }
            });

            function createForm(inputCount) {
                for (let i = 2; i <= inputCount; i++) {
                    const input = document.createElement("input");
                    input.type = "text";
                    input.placeholder = `Input ${i}`;
                    formContainer.appendChild(input);
                }
            }
        });
    </script>
</body>
</html>
