<?php
class ProductoController{

    private $db;
    private $producto;

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        $datebase = new Database();
        $this->db = $datebase->connect();
        $this->producto = new Producto($this->db);
    }
    public function index(){
        include 'views/layouts/header.php';
        include 'views/producto/index.php';
        include 'views/layouts/footer.php';
    }
    public function obtenerProducto(){
        header('Content-Type: application/json');
        try {
            $resultado = $this->producto->obtenerProducto();
            $productos = $resultado->fetchAll(PDO::FETCH_ASSOC);//SE ENCARGA DE TRAER TODOS LO REGISTROS
            echo json_encode([
                'status' => 'success',
                'data' => $productos,
        ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
        ]);
        }
    }
    public function guardarProducto(){
        //header ('Content-Type: application/json');//siempre va
        try {
            // Verificar si los campos del formulario están vacíos
            if (
                empty($_POST['nombre']) ||
                empty($_POST['descripcion']) ||
                empty($_POST['precio']) ||
                empty($_POST['stock'])
            ) {
                throw new Exception('Los campos son requeridos');
            }
        
        
//CARGAR DE DATA LAS VARIABLES QUE ESTAN EN /MODELS/PRODUCTO.PHP
            $this->producto->nombre = $_POST['nombre'];
            $this->producto->descripcion = $_POST['descripcion'];
            $this->producto->precio = $_POST['precio'];
            $this->producto->stock = $_POST['stock'];

            // Manejo de imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxSize = 5 * 1024 * 1024; // 5MB
                if (!in_array($_FILES['imagen']['type'], $allowedTypes)) {
                    throw new Exception('Tipo de archivo no permitido. Solo se permiten JPG, PNG y GIF.');
                }

                if ($_FILES['imagen']['size'] > $maxSize) {
                    throw new Exception('El archivo es demasiado grande. Máximo 5MB.');
                }
                $fileName = time() . '_' . basename($_FILES['imagen']['name']);
                $filePath = UPLOAD_PATH . $fileName;

                if (!is_dir(UPLOAD_PATH)) {
                    mkdir(UPLOAD_PATH, 0777, true);
                }

                if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $filePath)) {
                    throw new Exception('Error al subir la imagen');
                }

                $this->producto->imagen = $fileName;
                var_dump($_FILES);
            }
            
                if($this->producto->crearProducto())
                echo json_encode([
                   'status' =>'success',
                   'message' => 'Producto creado correctamente',
                ]);
                else {
                    throw new Exception ("Error al registrar producto");
                }
        }

        catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
    }
}
    public function actualizarProducto(){

    }
    public function eliminarProducto(){

    }
    public function detalleProducto(){

    }
}