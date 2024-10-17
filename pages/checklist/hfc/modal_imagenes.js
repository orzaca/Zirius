    // Función para mostrar el modal con la imagen seleccionada
    function showModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc; // Cambia la imagen en el modal
        document.getElementById('myModal').style.display = 'block'; // Muestra el modal
    }

    // Obtener el modal y el botón de cierre
    var modal = document.getElementById('myModal');
    var closeBtn = document.getElementsByClassName('close')[0];

    // Función para cerrar el modal cuando se hace clic en el botón de cierre
    closeBtn.onclick = function() {
        modal.style.display = 'none';
    }

    // Función para cerrar el modal cuando se hace clic fuera del contenido del modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }