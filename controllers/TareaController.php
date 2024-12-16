<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type');

// Simula una base de datos temporal en memoria (reemplazar con base de datos real)
$database = 'database.json';

// Verifica si el archivo de datos existe
if (!file_exists($database)) {
    file_put_contents($database, json_encode([]));
}

// Función para leer y guardar en el "archivo de datos"
function getDatabase() {
    global $database;
    return json_decode(file_get_contents($database), true);
}

function saveDatabase($data) {
    global $database;
    file_put_contents($database, json_encode($data, JSON_PRETTY_PRINT));
}

// Procesa la acción
$action = $_GET['action'] ?? null;

if ($action === 'obtener-tareas') {
    $tareas = getDatabase();
    echo json_encode([
        'status' => 'success',
        'data' => $tareas
    ]);
    exit;
}

if ($action === 'crear-tarea' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevaTarea = [
        'id_tarea' => uniqid(),
        'nombre' => $_POST['nombre'] ?? '',
        'descripcion' => $_POST['descripcion'] ?? '',
        'fecha' => $_POST['fecha'] ?? ''
    ];

    if (empty($nuevaTarea['nombre']) || empty($nuevaTarea['fecha'])) {
        echo json_encode(['status' => 'error', 'message' => 'El nombre y la fecha son obligatorios.']);
        exit;
    }

    $tareas = getDatabase();
    $tareas[] = $nuevaTarea;
    saveDatabase($tareas);

    echo json_encode([
        'status' => 'success',
        'message' => 'Tarea creada exitosamente.',
        'data' => $nuevaTarea
    ]);
    exit;
}

echo json_encode([
    'status' => 'error',
    'message' => 'Acción no reconocida.'
]);
