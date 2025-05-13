import Swal from 'sweetalert2';
    
// Exponer SweetAlert2 globalmente
window.Swal = Swal;    

const buttons = document.querySelectorAll('.btn-eliminar');

        buttons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const form = button.closest('form'); // ← cambio clave aquí

            Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed && form) {
                form.submit();
            }
            });
        });
        });
    window.mensajeConfirmacionEliminado = function () {
        Swal.fire('¡Eliminado!', 'El registro ha sido eliminado.', 'success');
    }

    window.mensajeConfirmacionNuevoElemento = function () {
        Swal.fire('¡Añadido!', 'El registro ha sido añadido correctamente.', 'success');
    }


    window.mensajeConfirmacionActualizacionElemento = function () {
        Swal.fire('¡Actualizado!', 'El registro ha sido actualizado correctamente.', 'success');
    }

    window.mensajeConfirmacionFichaje = function () {
        Swal.fire('¡Vamos a por ello!', 'Ha fichado correctamente.', 'success');
    }

    window.mensajeConfirmacionFichajeTerminado = function () {
        Swal.fire('¡Hasta la próxima!', 'Su fichaje en curso ha finalizado.', 'success');
    }