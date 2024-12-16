document.addEventListener('DOMContentLoaded', function() {
    // Verificar si el formulario de "Agregar nuevo empleado" está presente
    const form = document.getElementById('form-add-employee');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Evitar que se recargue la página

            // Recoger los datos del formulario
            const formData = new FormData(form);
            
            // Crear la solicitud AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'empleado/create', true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Si todo es exitoso, redirigir a la página de empleados
                    window.location.href = 'empleado';
                } else {
                    // Si hay un error, mostrarlo
                    alert('Hubo un error al agregar el empleado.');
                }
            };
            
            // Enviar los datos
            xhr.send(formData);
        });
    }
});
