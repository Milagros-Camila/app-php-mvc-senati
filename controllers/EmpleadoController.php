<?php
// controllers/EmpleadoController.php
class EmpleadoController {

    private $db;
    private $empleado;

    public function __construct() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        $datebase = new Database();
        $this->db = $datebase->connect();
        $this->empleado = new Empleado($this->db);
    }

    // Mostrar todos los empleados
    public function index() {
        $resultado = $this->empleado->obtenerEmpleados();
        $empleados = $resultado->fetchAll(PDO::FETCH_ASSOC); // Obtener todos los registros como un array

        // Verifica si se obtuvieron datos
        if ($empleados) {
            echo "Empleados encontrados: " . count($empleados);  // Esto es para depuración, elimina después
        } else {
            echo "No se encontraron empleados.";  // Esto también es para depuración
        }
        //var_dump($empleados);  // Esto debería mostrarte el contenido de la variable

        include 'views/layouts/header.php';
        include 'views/empleado/index.php';
        include 'views/layouts/footer.php';
    }

    // Obtener empleados desde la base de datos
    public function obtenerEmpleados() {
        header('Content-Type: application/json');
        try {
            $resultado = $this->empleado->obtenerEmpleados();
            $empleados = $resultado->fetchAll(PDO::FETCH_ASSOC); 
            echo json_encode([
                'status' => 'success',
                'data' => $empleados,
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    // Crear un nuevo empleado
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            var_dump($_POST)
            // Procesar el formulario

            $nombre = $_POST['nombre'];
            $cargo = $_POST['cargo'];
            $salario = $_POST['salario'];
            $fecha_ingreso = $_POST['fecha_ingreso'];
    
            $empleado = new Empleado($this->db);
            $empleado->nombre = $nombre;
            $empleado->cargo = $cargo;
            $empleado->salario = $salario;
            $empleado->fecha_ingreso = $fecha_ingreso;
    
            if ($empleado->crearEmpleado()) {
                header("Location: " . BASE_URL . "/empleado");
            } else {
                echo "Error al crear el empleado";
            }
        }
        // Mostrar el formulario solo cuando es una solicitud GET
        include 'views/empleado/create.php';
    }
    

    // Editar un empleado
    public function edit($id) {
        $this->empleado->id = $id;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->empleado->nombre = $_POST['nombre'];
            $this->empleado->cargo = $_POST['cargo'];
            $this->empleado->salario = $_POST['salario'];
            $this->empleado->fecha_ingreso = $_POST['fecha_ingreso'];

            if ($this->empleado->actualizarEmpleado()) {
                header('Location: ' . BASE_URL . '/empleados');
                exit();
            } else {
                echo "Error al actualizar el empleado.";
            }
        }
        // Obtener datos del empleado
        $empleado = $this->empleado->obtenerEmpleados()->fetch(PDO::FETCH_ASSOC);
        include 'views/empleado/edit.php';
    }

    // Eliminar un empleado
    public function delete($id) {
        $this->empleado->id = $id;
        if ($this->empleado->eliminarEmpleado()) {
            header('Location: ' . BASE_URL . '/empleados');
            exit();
        } else {
            echo "Error al eliminar el empleado.";
        }
    }
}
