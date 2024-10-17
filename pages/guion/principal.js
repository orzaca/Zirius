function loadContent(url) {
    // Remover la clase activa de todas las pestañas
    var tabs = document.querySelectorAll('.tab');
    tabs.forEach(function(tab) {
        tab.classList.remove('active');
    });

    // Activar la pestaña seleccionada
    var activeTab = document.querySelector('.tab[onclick="loadContent(\'' + url + '\')"]');
    activeTab.classList.add('active');

    // Realizar la solicitud AJAX para cargar el contenido
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            // Actualizar el contenedor de contenido dinámico
            document.getElementById('dynamic-content').innerHTML = xhr.responseText;
        } else {
            document.getElementById('dynamic-content').innerHTML = '<h2>Índice</h2><p>Error al cargar el contenido.</p>';
        }
    };
    xhr.onerror = function() {
        document.getElementById('dynamic-content').innerHTML = '<h2>Índice</h2><p>Error de red.</p>';
    };
    xhr.send();
}

// Cargar el contenido inicial de la pestaña activa por defecto
document.addEventListener('DOMContentLoaded', function() {
    // Establecer un contenido inicial en el contenedor
    document.getElementById('dynamic-content').innerHTML = '<h2>Índice</h2><p>Bienvenido a la página. Aquí está el contenido que puedes explorar...</p>';
    
    // Cargar el contenido de la primera URL después de establecer el contenido inicial
    loadContent('<?php echo $urls[0]; ?>');
});

// Event delegation para manejar los clics del botón en contenido dinámico
document.addEventListener('click', function(event) {
    if (event.target.matches('.btn')) {
        copyToClipboard();
    }
});
