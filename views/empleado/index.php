<!-- views/empleado/index.php -->
<h1>Lista de Empleados</h1>
<a href="<?= BASE_URL ?>/empleado/create">Agregar nuevo empleado</a>
<table>
    <tr>
        <th>Nombre</th>
        <th>Cargo</th>
        <th>Salario</th>
        <th>Fecha de Ingreso</th>
        <th>Acciones</th>
    </tr>
    <?php if (!empty($empleados)): ?>
        <?php foreach ($empleados as $empleado): ?>
            <tr>
                <td><?= $empleado['nombre'] ?></td>
                <td><?= $empleado['cargo'] ?></td>
                <td><?= $empleado['salario'] ?></td>
                <td><?= $empleado['fecha_ingreso'] ?></td>
                <td>
                    <a href="<?= BASE_URL ?>/empleado/edit/<?= $empleado['id'] ?>">Editar</a>
                    <a href="<?= BASE_URL ?>/empleado/delete/<?= $empleado['id'] ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No hay empleados registrados.</td>
        </tr>
    <?php endif; ?>
</table>
