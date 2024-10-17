document.getElementById('load-guion').addEventListener('click', function() {
    document.getElementById('manuales-section').style.display = 'none';
    document.getElementById('checklist-section').style.display = 'none';
    document.getElementById('guion-section').style.display = 'block';
    document.getElementById('quejas-section').style.display = 'none';
    document.getElementById('wf-section').style.display = 'none'
    document.querySelector('.news-section').style.display = 'none';
    document.querySelector('.module-1').style.display = 'none';
    document.querySelector('.module-2').style.display = 'none';
    document.querySelector('.noticias').style.display = 'none';
    document.querySelector('.module-3').style.display = 'none';
});



document.getElementById('load-wf').addEventListener('click', function() {
    document.getElementById('wf-section').style.display = 'block';
    document.getElementById('checklist-section').style.display = 'none';
    document.getElementById('guion-section').style.display = 'none';
    document.getElementById('quejas-section').style.display = 'none';
    document.getElementById('manuales-section').style.display = 'none'
    document.querySelector('.news-section').style.display = 'none';
    document.querySelector('.module-1').style.display = 'none';
    document.querySelector('.module-2').style.display = 'none';
    document.querySelector('.noticias').style.display = 'none';
    document.querySelector('.module-3').style.display = 'none';

 
});

/*
document.getElementById('load-checklist').addEventListener('click', function() {
    document.getElementById('wf-section').style.display = 'none';
    document.getElementById('checklist-section').style.display = 'block';
    document.getElementById('guion-section').style.display = 'none';
    document.getElementById('quejas-section').style.display = 'none';
    document.getElementById('manuales-section').style.display = 'none'
    document.querySelector('.news-section').style.display = 'none';
    document.querySelector('.module-1').style.display = 'none';
    document.querySelector('.module-2').style.display = 'none';
    document.querySelector('.noticias').style.display = 'none';
    document.querySelector('.module-3').style.display = 'none';


});


    document.getElementById('load-quejas').addEventListener('click', function() {
    document.getElementById('manuales-section').style.display = 'none';
    document.getElementById('checklist-section').style.display = 'none';
    document.getElementById('guion-section').style.display = 'block';
    document.getElementById('quejas-section').style.display = 'none';
    document.getElementById('wf-section').style.display = 'none'
    document.querySelector('.news-section').style.display = 'none';
    document.querySelector('.module-1').style.display = 'none';
    document.querySelector('.module-2').style.display = 'none';
    document.querySelector('.noticias').style.display = 'none';
    document.querySelector('.module-3').style.display = 'none';
});*/





// link Guiones, Checklist y Quejas
document.addEventListener('DOMContentLoaded', function() {
    const guionLink = document.getElementById('load-guion');
    const checklistLink = document.getElementById('load-checklist');
    const quejasLink = document.getElementById('load-quejas'); // Enlace de Quejas
    const wfLink = document.getElementById('load-wf'); // Enlace de Quejas
    const guionSection = document.getElementById('guion-section');
    const checklistSection = document.getElementById('checklist-section');
    const quejasSection = document.getElementById('quejas-section'); // Sección de Quejas
    const wfSection = document.getElementById('wf-section'); // Sección de Quejas


    // Función para ocultar el contenido principal
    function ocultarContenidoPrincipal() {
        document.querySelector('.news-section').style.display = 'none';
        document.querySelector('.module-1').style.display = 'none';
        document.querySelector('.module-2').style.display = 'none';
        document.querySelector('.noticias').style.display = 'none';
        document.querySelector('.module-3').style.display = 'none';
              }

    // Enlace de Guiones
    guionLink.addEventListener('click', function(event) {
        event.preventDefault(); // Evita la acción por defecto del enlace
        ocultarContenidoPrincipal();
        // Muestra la sección de guiones y oculta las otras
        guionSection.style.display = 'block';
        checklistSection.style.display = 'none';
        quejasSection.style.display = 'none'; //
        wfSection.style.display = 'none'; //


        fetch('/pages/guion/principal.php')
            .then(response => response.text())
            .then(html => {
                guionSection.innerHTML = html;
            })
            .catch(error => {
                console.error('Error al cargar principal.php:', error);
            });
    });

/*    // Enlace de Checklist
    checklistLink.addEventListener('click', function(event) {
        event.preventDefault(); // Evita la acción por defecto del enlace
        ocultarContenidoPrincipal();
        checklistSection.style.display = 'block';
        guionSection.style.display = 'none';
        quejasSection.style.display = 'none'; 
        wfSection.style.display = 'none'; 
        

        // Carga el contenido de checklist
        fetch('https://zirius.online/pages/checklist/inicio_checklist.html')
            .then(response => response.text())
            .then(html => {
                checklistSection.innerHTML = html;
            })
            .catch(error => {
                console.error('Error al cargar Inicio_checklist.php:', error);
            });
    });*/

    // Enlace de quejas
    quejasLink.addEventListener('click', function(event) {
        event.preventDefault(); // Evita la acción por defecto del enlace

        ocultarContenidoPrincipal();

        quejasSection.style.display = 'block';
        wfSection.style.display = 'none';
        guionSection.style.display = 'none';
        checklistSection.style.display = 'none';


        // Carga el contenido de quejas
        fetch('/pages/quejas/memo_dsl_internet.html')
            .then(response => response.text())
            .then(html => {
                quejasSection.innerHTML = html;
            })
            .catch(error => {
                console.error('Error al cargar principal_quejas.php:', error);
            });
    });

    // Enlace de wf
    wfLink.addEventListener('click', function(event) {
        event.preventDefault(); // Evita la acción por defecto del enlace

        ocultarContenidoPrincipal();
        // Muestra la sección de quejas y oculta las otras
        wfSection.style.display = 'block';
        quejasSection.style.display = 'none';
        guionSection.style.display = 'none';
        checklistSection.style.display = 'none';

        // Carga el contenido de quejas
        fetch('https://zirius.online/pages/wf.html')
            .then(response => response.text())
            .then(html => {
                wfSection.innerHTML = html;
            })
            .catch(error => {
                console.error('Error al cargar modulo de wf', error);
            });
    });
});
