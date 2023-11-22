<?php
include 'database.php';
include 'employee.php';

$datosEmpleado = null;

// Verificar si estamos cargando el formulario por primera vez
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $employeeId = $_GET['id'];

    // Obtener los datos del empleado para editar
    $sql = "SELECT id, nombre, apellido, telefono, correo, puesto FROM empleados WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employeeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $datosEmpleado = $result->fetch_assoc();
    } else {
        echo "Empleado no encontrado.";
    }
}

// Procesar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $puesto = $_POST['puesto'];

    $employee = new Employee($id, $nombre, $apellido, $telefono, $correo, $puesto);

    if ($employee->update()) {
        echo "Información del empleado actualizada con éxito.";
    } else {
        echo "Error al actualizar la información del empleado.";
    }
}
?>

<!-- HTML y formulario para la edición de un empleado -->
<!DOCTYPE html>
<html>
<head>
    <title>Editar Empleado</title>
</head>
<body>
    <h1>Editar Información del Empleado</h1>

    <?php if ($datosEmpleado): ?>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($datosEmpleado['id']); ?>">

            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($datosEmpleado['nombre']); ?>" required><br>

            <label for="apellido">Apellido:</label><br>
            <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($datosEmpleado['apellido']); ?>" required><br>

            <label for="telefono">Teléfono:</label><br>
            <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($datosEmpleado['telefono']); ?>" required><br>

            <label for="correo">Correo Electrónico:</label><br>
            <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($datosEmpleado['correo']); ?>" required><br>

            <label for="puesto">Puesto:</label><br>
            <input type="text" id="puesto" name="puesto" value="<?php echo htmlspecialchars($datosEmpleado['puesto']); ?>" required><br>

            <input type="submit" value="Actualizar Información">
        </form>
        <?php else: ?>
            <a href="index.php"><button>Regresar a Lista de Empleados</button></a>
        <?php endif; ?>        
</body>
</html>