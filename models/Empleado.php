<?php
// models/Empleado.php
class Empleado
{

    private $conn;

    public $id;
    public $nombre;
    public $cargo;
    public $salario;
    public $fecha_ingreso;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Obtener todos los empleados
    public function obtenerEmpleados()
    {
        $query = "SELECT * FROM empleados ORDER BY fecha_ingreso DESC"; // Ajusta la consulta si es necesario
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Crear un nuevo empleado
    public function crearEmpleado()
    {
        $query = "INSERT INTO empleados (nombre, cargo, salario, fecha_ingreso) 
                  VALUES (:nombre, :cargo, :salario, :fecha_ingreso)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':cargo', $this->cargo);
        $stmt->bindParam(':salario', $this->salario);
        $stmt->bindParam(':fecha_ingreso', $this->fecha_ingreso);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar un empleado
    public function actualizarEmpleado()
    {
        $query = "UPDATE empleados SET nombre = :nombre, cargo = :cargo, salario = :salario, fecha_ingreso = :fecha_ingreso WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':cargo', $this->cargo);
        $stmt->bindParam(':salario', $this->salario);
        $stmt->bindParam(':fecha_ingreso', $this->fecha_ingreso);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar un empleado
    public function eliminarEmpleado()
    {
        $query = "DELETE FROM empleados WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
