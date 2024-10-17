document.addEventListener('DOMContentLoaded', function() {
    const wfLink = document.getElementById('load-wf');
    const wfSection = document.getElementById('wf-section');
    const wfIframe = document.getElementById('wf-iframe');
    const module1 = document.querySelector('.module-1');
    const module2 = document.querySelector('.module-2');
    const module3 = document.querySelector('.module-3');
    const noticias = document.querySelector('.noticias');
    const quejasSection = document.querySelector('.quejas-section');
    const checklistSection = document.querySelector('.checklist-section');


    wfLink.addEventListener('click', function(event) {
        event.preventDefault(); // Evita que el enlace recargue la página
        
        // Oculta los módulos del dashboard
        module1.style.display = 'none';
        module2.style.display = 'none';
        module3.style.display = 'none';
        noticias.style.display = 'none';
        quejasSection.style.display = 'none';
      checklistSection.style.display = 'none';
        
        // Muestra la sección de quejas y carga el iframe
        wfSection.style.display = 'block';
        wfIframe.src = 'https://zirius.online/pages/wf/wf.html'; // Carga el archivo en el iframe
    });
});
