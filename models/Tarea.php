<?php
// models/Tarea.php
class Tarea {
    private $conn;

    public $id_tarea;
    public $titulo;
    public $descripcion;
    public $fecha_creacion;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todas las tareas
    public function obtenerTareas() {
        $query = "SELECT * FROM tarea ORDER BY fecha_creacion DESC"; // Ordenar por fecha de creación
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Crear una nueva tarea
    public function crearTarea() {
        $query = "INSERT INTO tarea (titulo, descripcion, estado) 
                  VALUES (:titulo, :descripcion, :estado)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':estado', $this->estado);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar tarea
    public function actualizarTarea() {
        $query = "UPDATE tarea SET 
                    titulo = :titulo, 
                    descripcion = :descripcion, 
                    estado = :estado
                  WHERE id_tarea = :id_tarea";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':id_tarea', $this->id_tarea);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar tarea
    public function eliminarTarea() {
        $query = "DELETE FROM tarea WHERE id_tarea = :id_tarea";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_tarea', $this->id_tarea);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Obtener tarea por ID
    public function obtenerTareaPorId($id) {
        $query = "SELECT * FROM tarea WHERE id_tarea = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $this->titulo = $row['titulo'];
            $this->descripcion = $row['descripcion'];
            $this->estado = $row['estado'];
            return true;
        }
        return false;
    }
}
?>
