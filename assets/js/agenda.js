// Cargar las tareas
async function mostrarTareas() {
    try {
        const respuesta = await fetch('agendaController.php?action=obtener-tareas');
        const resultado = await respuesta.json();

        if (resultado.status === 'error') {
            throw new Error(resultado.message);
        }

        const tareas = resultado.data;
        const contenedor = document.getElementById('contenedorPrincipal');
        if (tareas.length === 0) {
            contenedor.innerHTML = '<h2>No hay tareas registradas</h2>';
            return;
        }

        contenedor.innerHTML = `
            <h2>Lista de Tareas</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody id="tareasTableBody"></tbody>
            </table>
        `;

        const tbody = document.getElementById('tareasTableBody');
        tareas.forEach(tarea => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${tarea.id_tarea}</td>
                <td>${tarea.nombre}</td>
                <td>${tarea.descripcion || '<span class="text-muted">Sin descripción</span>'}</td>
                <td>${tarea.fecha}</td>
            `;
            tbody.appendChild(tr);
        });
    } catch (error) {
        showAlert('error', 'Error al cargar las tareas: ' + error.message);
    }
}

// Guardar nueva tarea
async function crearTarea() {
    const nombre = document.getElementById('nombre').value;
    const descripcion = document.getElementById('descripcion').value;
    const fecha = document.getElementById('fecha').value;

    try {
        const respuesta = await fetch('agendaController.php?action=crear-tarea', {
            method: 'POST',
            body: new URLSearchParams({
                nombre: nombre,
                descripcion: descripcion,
                fecha: fecha
            }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });

        const resultado = await respuesta.json();
        if (resultado.status === 'success') {
            showAlert('success', resultado.message);
            mostrarTareas(); // Recargar la lista de tareas
        } else {
            showAlert('error', resultado.message);
        }
    } catch (error) {
        showAlert('error', 'Error al crear la tarea: ' + error.message);
    }
}
