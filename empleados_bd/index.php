<?php
include 'database.php';

$sql = "SELECT id, nombre, apellido, telefono, correo, puesto FROM empleados";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Empleados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        table {
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
        <script>
        function validarFormulario() {
            var nombre = document.forms["formEmpleado"]["nombre"].value;
            var apellido = document.forms["formEmpleado"]["apellido"].value;
            var telefono = document.forms["formEmpleado"]["telefono"].value;
            var correo = document.forms["formEmpleado"]["correo"].value;
            var puesto = document.forms["formEmpleado"]["puesto"].value;

            if (nombre == "" || apellido == "" || telefono == "" || correo == "" || puesto == "") {
                alert("Todos los campos deben ser llenados");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Proyecto de Gestión de Empleados</h1>
        <!-- Botón para agregar un nuevo empleado -->
<a href="create.php"><button style="margin-bottom: 20px;">Agregar Nuevo Empleado</button></a>

    <table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Puesto</th>
        <th>Editar</th>
        <th>Eliminar</th>
    </tr>
        <?php
        // Asumiendo que $result es el resultado de tu consulta SQL
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"]. "</td>";
            echo "<td>" . $row["nombre"]. "</td>";
            echo "<td>" . $row["apellido"]. "</td>";
            echo "<td>" . $row["telefono"]. "</td>";
            echo "<td>" . $row["correo"]. "</td>";
            echo "<td>" . $row["puesto"]. "</td>";
            echo "<td><a href='update.php?id=" . $row["id"] . "'>Editar</a></td>";
            echo "<td><a href='delete.php?id=" . $row["id"] . "'>Eliminar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <footer>
        <p>Por: Jose Munguia</p>
    </footer>
</body>
</html>
<?php
$conn->close();
?>

