<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Agenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://kit.fontawesome.com/a076d05399.js" rel="stylesheet">  <!-- Para los iconos -->
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center mb-4">
            <h1>Bienvenido al Sistema de Gestión de Agenda</h1>
            <p class="lead">Administra tus tareas y proyectos de manera fácil y eficiente</p>
        </div>
    </div>

    <div class="row">
        <!-- Tarjeta para ver la agenda -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-calendar fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">Ver Agenda</h5>
                    <p class="card-text">Consulta todas tus tareas y eventos en la agenda.</p>
                    <button id="verAgendaBtn" class="btn btn-primary">Ir a Agenda</button>
                </div>
            </div>
        </div>

        <!-- Tarjeta para agregar nueva tarea -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-plus-circle fa-3x mb-3 text-success"></i>
                    <h5 class="card-title">Agregar Tarea</h5>
                    <p class="card-text">Añade nuevas tareas o eventos a tu agenda.</p>
                    <button id="agregarTareaBtn" class="btn btn-success">Agregar Tarea</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenedor dinámico -->
    <div id="contenedorPrincipal" class="mt-4"></div>

    <!-- Contenedor para alertas -->
    <div id="alertContainer"></div>
</div>
<script>
    document.getElementById('verAgendaBtn').onclick = function() {
        window.location.href = "tarea/index.php"; // Cambia la URL según sea necesario
    };
</script>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="assets/js/agenda.js"></script>
</body>
</html>
