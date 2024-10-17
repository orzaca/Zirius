document.addEventListener('DOMContentLoaded', function () {
    // Selecciona todos los enlaces del menú
    const buttons = document.querySelectorAll('.menu_iniciocheck a');
    const contentDiv = document.getElementById('content');

    // Agrega un evento de click a cada enlace
    buttons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Prevenir que el enlace recargue la página

            const page = this.getAttribute('data-page'); // Obtiene el valor de 'data-page'

            // Realiza una solicitud AJAX para cargar la página
            fetch(`/pages/checklist/${page}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al cargar la página');
                    }
                    return response.text();
                })
                .then(data => {
                    // Actualiza el contenido del div con la respuesta de la página cargada
                    contentDiv.innerHTML = data;
                })
                .catch(error => {
                    contentDiv.innerHTML = `<p>Error al cargar el contenido: ${error}</p>`;
                });
        });
    });
});
