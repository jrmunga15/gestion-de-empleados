<?php
include 'database.php';
include 'Employee.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeId = $_POST['id'];

    $employee = new Employee($employeeId, "", "", "", "", "");

    if ($employee->delete()) {
        echo "Empleado eliminado con éxito.";
        // Botón para regresar a la lista de empleados
        echo "<br><a href='index.php'><button>Regresar a la Lista de Empleados</button></a>";
    } else {
        echo "Error al eliminar el empleado.";
        // Botón para regresar a la lista de empleados
        echo "<br><a href='index.php'><button>Regresar a la Lista de Empleados</button></a>";
    }
} else {
    if (isset($_GET['id'])) {
        $employeeId = $_GET['id'];
        echo "<h1>Confirmación de Eliminación</h1>";
        echo "<p>¿Estás seguro de que deseas eliminar al empleado con ID: $employeeId?</p>";
        echo "<form method='post' action=''>
                <input type='hidden' name='id' value='$employeeId'>
                <input type='submit' value='Eliminar'>
              </form>";
        // Botón para regresar a la lista de empleados
        echo " <a href='index.php'><button>Regresar</button></a>";      
    } else {
        echo "No se ha especificado un ID de empleado válido.";
    }
}
?>
