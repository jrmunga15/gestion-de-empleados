<?php
include 'database.php';
include 'Employee.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $puesto = $_POST['puesto'];

    $employee = new Employee(null, $nombre, $apellido, $telefono, $correo, $puesto);

    if ($employee->create()) {
        echo "Empleado agregado con éxito.";
    } else {
        echo "Error al agregar empleado.";
    }
}
?>

<!-- Formulario HTML para crear un nuevo empleado -->
<!DOCTYPE html>
<html>
<head>
    <title>Crear Empleado</title>
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
    <h1>Agregar Nuevo Empleado</h1>
    <form action="create.php" method="post">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" required><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" required><br>

        <label for="correo">Correo Electrónico:</label><br>
        <input type="email" id="correo" name="correo" required><br>

        <label for="puesto">Puesto:</label><br>
        <input type="text" id="puesto" name="puesto" required><br>

        <input type="submit" value="Agregar Empleado">
    </form>
    <a href="index.php"><button>Regresar a Lista de Empleados</button></a>
</body>
</html>
