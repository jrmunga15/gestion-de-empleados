<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['employee_id'])) {
    $employeeId = $_GET['employee_id'];

    // Realiza la búsqueda del empleado por ID en la base de datos
    $sql = "SELECT id, nombre, apellido, telefono, correo, puesto FROM empleados WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employeeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Mostrar los resultados en una tabla
        echo "<h2>Resultado de la búsqueda:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Teléfono</th><th>Correo</th><th>Posición</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["apellido"] . "</td>";
            echo "<td>" . $row["telefono"] . "</td>";
            echo "<td>" . $row["correo"] . "</td>";
            echo "<td>" . $row["puesto"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Agregar un estilo CSS para que el enlace se vea como un botón
        echo "<style>
                .back-button {
                    background-color: #4CAF50;
                    color: white;
                    padding: 10px 15px;
                    border: none;
                    border-radius: 4px;
                    text-decoration: none;
                    display: inline-block;
                    margin-top: 10px;
                }
                .back-button:hover {
                    background-color: #45a049;
                }
              </style>";

        // Agregar un botón para regresar a la lista de empleados
        echo "<a href='index.php' class='back-button'>Regresar a la Lista de Empleados</a>";
    } else {
        echo "Empleado no encontrado.";
    }
}
?>
