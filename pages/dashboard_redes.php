<?php
session_start();
require '../includes/db.php';

// Verifica si el usuario está logueado
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'redes') {
    header("Location: login.php");
    exit;
}

// Recupera la información del usuario
$user_id = $_SESSION['user_id'];
$sql = "SELECT email FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();
$email = $user['email'];

// Recupera las noticias del sistema
$news_sql = "SELECT title, content, created_at FROM system_news ORDER BY created_at DESC";
$news_stmt = $pdo->prepare($news_sql);
$news_stmt->execute();
$news_list = $news_stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Telefonico</title>
    <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/dashboard_telefonico.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Barra superior -->
    <header class="header">
        <nav class="navbar">
            <!-- Skill y Campaña -->
            <div class="navbar-left">
                <h3>Claro Guatemala - Fijo Soporte</h3>
            </div>
                    <!-- Skill y Campaña -->
            <div class="navbar-icons">
                <a href="dashboard_telefonico.php" class="icon" title="Inicio"><i class="fas fa-home"></i></a>
                <a href="#" class="icon" title="Mensajes"><i class="fas fa-envelope"></i></a>
                <a href="#" class="icon" title="Configuración"><i class="fas fa-cog"></i></a>
                <a href="#" class="icon" title="Ayuda"><i class="fas fa-question-circle"></i></a>
                <a href="#" class="icon" id="theme-toggle" title="Modo oscuro"><i class="fas fa-moon"></i></a>
            </div>
            <div class="navbar-right">
                <span>Hola, <?php echo htmlspecialchars($email); ?></span>
                <a href="logout.php" class="logout-link">Cerrar sesión</a>
            </div>
        </nav>
    </header>
    
    <!-- Menu Lateral -->
    <aside class="sidebar">
        
        <div class="logo"> <!-- logo de mi empresa Zirius -->
            <img src="/assets/img/logo.png" alt="Logo" class="logo-img">
            
        </div>
        <ul class="menu">
                  <li><a href="#" id="load-guion"><i class="fas fa-comments"></i> Guiones</a></li>
            <li><a href="#" id="load-checklist"><i class="fas fa-check-circle"></i> Checklist</a></li>
            <li><a href="#" id="load-quejas"><i class="fas fa-sticky-note"></i> Memo de quejas</a></li>
            <li><a href="#" id="load-wf"><i class="fas fa-layer-group"></i> Plantillas WF</a></li>
            <li><a href="#" ><i class="fas fa-book"></i> Manuales</a></li>
            <li><a href="#" id="load-orden"><i class="fas fa-clipboard-list"></i> Ordenes de Servicios</a></li>
            <li><a href="#" id="load-zonas"><i class="fas fa-map-marked-alt"></i> Zonas operativas</a></li>
            <li><a href="#" id="load-training"><i class="fas fa-chalkboard-teacher"></i> Zirius Training</a></li>
             <li><a href="#" id="load-guion"><i class="fas fa-comments"></i> Guiones</a></li>
            <li><a href="#" id="load-config"><i class="fas fa-cog"></i> Configuración</a></li>
        </ul>

        
        <footer class="footer"> <!-- creditos del desarrollador: Orlando Zambrano -->
            <p>&copy; 2024 Orlando Zambrano.</p>
        </footer>

    </aside>


    <main class="main-content">
        <div class="module-1">
            <p class="titulo_modulo">Acceso Directo</p>
        </br>
        <div class="image-grid">
            <a href="http://172.17.8.153:9673/live/AXCustomerSupportPortal/#/login" target="_blank" rel="noreferrer noopener">
                <img src="/assets/img/axiros.png" alt="axiros">
                <span>Axiros</span>
            </a>
            <a href="https://qflowgt/QFlow62/SignIn.aspx" target="_blank" rel="noreferrer noopener">
                <img src="/assets/img/qflow.png" alt="Imagen 2">
                <span>Qflow</span>
            </a>
            <a href="pagina3.html">
                <img src="/assets/img/fallas.png" alt="Imagen 3">
                <span>Fallas</span>
            </a>
            <a href="pagina4.html" target="_blank">
                <img src="/assets/img/eta.png" alt="Imagen 4">
                <span>ETA</span>
            </a>
            <a href="pagina5.html">
                <img src="/assets/img/ump.png"alt="Imagen 5">
                <span>UMP Soporte</span>
            </a>
            <a href="http://clarovideo.sac.claro.com.gt:5502/ClaroVideoGt/" target="_blank" rel="noreferrer noopener">
                <img src="/assets/img/gui.jpg" alt="Imagen 6">
                <span>GUI Claro Video</span>
            </a>
            <a href="pagina7.html">
                <img src="/assets/img/skyway.png" alt="Imagen 7">
                <span>SkyWay</span>
            </a>
            <a href="pagina8.html">
                <img src="/assets/img/intrasac.png" alt="Imagen 8">
                <span>Intrasac</span>
            </a>
            <a href="pagina9.html">
                <img src="/assets/img/restricciones.jpg" alt="Imagen 9">
                <span>Restricciones</span>
            </a>
            <a href="pagina10.html">
                <img src="/assets/img/check.png" alt="Imagen 10">
                <span>Checklist</span>
            </a>
        </div>

    </div>
    <div class="module-2">
        <h2 class="titulo_modulo">Métricas Mes</h2>
        <div class="metrics-container">
            <div class="metric-item">
                <h3>TMO</h3>
                <p class="metric-value">15:30</p> <!-- Reemplaza con el valor real -->
            </div>
            <div class="metric-item">
                <h3>QA</h3>
                <p class="metric-value">85%</p> <!-- Reemplaza con el valor real -->
            </div>
        </div>
    </div>

    <div class="module-3">
        <h2 class="titulo_modulo">Grillas TV</h2>
        <di class="image-modulo3">
        </br>
        <a href="pagina1.html">
            <img src="/assets/img/clarohogar.jpg" alt="IPTV">
            <span>Grilla IPTV</span>
        </a>
        <a href="pagina2.html">
            <img src="/assets/img/clarotvplus.png" alt="HFC">
            <span>Grilla HFC</span>
        </a>
        <a href="pagina3.html">
            <img src="/assets/img/tv.jpg" alt="DTH">
            <span>Grilla DTH</span>
        </a>


    </div>
</div>




<!-- Sección de Mensajes -->

<div class="noticias">
    
    <section class="news-section">

        <h2>Mensajes</h2>
        
        <ul>
            <?php foreach ($news_list as $news): ?>
                <li>
                    <h3><?php echo htmlspecialchars($news['title']); ?></h3>
                    <p><?php echo htmlspecialchars($news['content']); ?></p>
                    <span><?php echo htmlspecialchars($news['created_at']); ?></span>
                    <hr class="custom-line">
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</div>




<!-- Section para los modulos en el principal -->
<div class="top-modules">
    <div id="floating-button" class="floating-button">
        <button id="open-form-button">Tipificación</button>
    </div>

    <!-- Contenedor flotante del formulario -->
    <div id="floating-form-container" class="floating-form-container">
        <button type="button" id="minimize-form-button" class="minimize-button">
            <i class="fas fa-window-minimize"></i>
        </button> 
        <form action="save_tipification.php" method="POST" id="tipification-form"><p>Tipificador</p>
            <input type="text" id="call_id" name="call_id" placeholder="ID llamada" required>
            <input type="text" id="client_name" name="client_name" placeholder="Nombre del Cliente" required>
            <input type="text" id="line" name="line" placeholder="Línea" required> 
            <textarea id="reported_problem" name="reported_problem" placeholder="Problema Reportado" rows="3" required></textarea>
            <textarea id="tests" name="tests" placeholder="Pruebas" rows="3" required></textarea>
            <div class="button-container">
                <button type="submit" class="styled-button">Guardar</button>
                <button type="button" id="copy-button" class="styled-button copy-button">Copiar</button>
            </div>
        </form>
    </div>


    <!-- Cronómetro Flotante
    <button id="show-timer-btn">Cronómetro</button>
    <div class="floating-timer" id="floating-timer">
        <h3>Cronómetro</h3>
        <div id="timer">
            <span id="hours">00</span>:<span id="minutes">00</span>:<span id="seconds">00</span>
        </div>
        <button id="start-btn">Iniciar</button>
        <button id="stop-btn">Detener</button>
        <button id="reset-btn">Reiniciar</button>
    </div> -->

</div>


<section class="checklist-section" id="checklist-section" style="display: none;">
    <!-- Contenido de checklist.php se cargará aquí -->
</section>

<section class="guion-section" id="guion-section" style="display: none;">
    <!-- Contenido de guion.php se cargará aquí -->
</section>

<section class="quejas-section" id="quejas-section" style="display: none;">
    <!-- Contenido de guion.php se cargará aquí -->
</section>


<section class="manuales-section" id="manuales-section" style="display: none; margin-top: 5px; position: absolute; left: 130px; top:50px; width: 80%; height: 800px;">
    <iframe id="manuales-iframe" src="" frameborder="0" style="width: 80%; height: 800px; border: none; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);"></iframe>
</section>

<section class="wf-section" id="wf-section" style="display: none; margin-top: 5px; position: absolute; left: 130px; top:50px; width: 80%; height: 800px;">
    <iframe id="wf-iframe" src="" frameborder="0" style="width: 80%; height: 800px; border: none; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);"></iframe>
</section>


</main>

<script src="/assets/js/theme-toggle.js" defer></script>  <!-- Controla el modo nocturno -->
<script src="/assets/js/step.js"></script> <!-- controla las acciones en los checklist -->
<script src="/assets/js/controlador_telefonico.js"></script>  <!-- controla todo los procesos en dashboard -->
<script src="/assets/js/cronometro.js"></script> <!-- controla cronometro -->
<script src="/assets/js/tipiform.js"></script> <!-- controla el tipificador -->
<script src="/assets/js/noticias.js"></script> <!-- controla la seccion de mensajes -->
<script src="/assets/js/principal.js"></script> <!-- controla la opcion de guiones-->
<script src="/assets/js/memo_dsl_internet.js"></script> <!-- controla el copiar del memo de las quejas-->



</body>
</html>