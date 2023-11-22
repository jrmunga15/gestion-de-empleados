<?php
class Employee {
    private $id;
    private $nombre;
    private $apellido;
    private $telefono;
    private $correo;
    private $puesto;

    // Constructor
    public function __construct($id, $nombre, $apellido, $telefono, $correo, $puesto) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->puesto = $puesto;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getpuesto() {
        return $this->puesto;
    }

    // Setters
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setpuesto($puesto) {
        $this->puesto = $puesto;
    }

    // Métodos para interactuar con la base de datos (CRUD)
    
    // Lógica para crear un empleado en la base de datos
    public function create() {
        
        global $conn; // Asegúrate de tener una variable de conexión global o pásala de otra manera
    
        $sql = "INSERT INTO empleados (nombre, apellido, telefono, correo, puesto) VALUES (?, ?, ?, ?, ?)";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $this->nombre, $this->apellido, $this->telefono, $this->correo, $this->puesto);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Lógica para leer la información de los empleados
    public function read() {
        global $conn;

        $sql = "SELECT id, nombre, apellido, telefono, correo, puesto FROM employees";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return null;
        }
    }

    // Lógica para actualizar la información de un empleado
    public function update() {
        global $conn;

        $sql = "UPDATE empleados SET nombre = ?, apellido = ?, telefono = ?, correo = ?, puesto = ? WHERE id = ?";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $this->nombre, $this->apellido, $this->telefono, $this->correo, $this->puesto, $this->id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Lógica para eliminar un empleado
    public function delete() {
        global $conn;

        $sql = "DELETE FROM empleados WHERE id = ?";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $this->id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
