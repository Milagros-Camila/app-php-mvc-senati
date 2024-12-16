<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/estilos.css">

<!-- views/empleado/create.php -->
<h1>Agregar Nuevo Empleado</h1>

<form action="<?= BASE_URL ?>/empleado/create" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="cargo">Cargo:</label>
    <input type="text" id="cargo" name="cargo" required>

    <label for="salario">Salario:</label>
    <input type="number" id="salario" name="salario" required>

    <label for="fecha_ingreso">Fecha de Ingreso:</label>
    <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>

    <button type="submit">Guardar Empleado</button>
</form>

<!-- Agregar este script en la parte inferior de tu HTML -->
<script src="<?= BASE_URL ?>/assets/js/empleado.js"></script>

