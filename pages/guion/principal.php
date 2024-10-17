<?php
session_start();
require '/home/ziriuson/public_html/includes/db.php';

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
$email = htmlspecialchars($user['email']); // Escapar para seguridad

// Obtener los nombres de las pestañas desde la base de datos usando PDO
$sqlPestanas = "SELECT nombre FROM nombres_pestanas";
$stmtPestanas = $pdo->prepare($sqlPestanas);
$stmtPestanas->execute();
$nombres = $stmtPestanas->fetchAll(PDO::FETCH_COLUMN); // Usamos fetchAll para obtener todas las filas como un array simple
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Guiones</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <link rel="stylesheet" href="/assets/css/guion/principal_guion.css">


</head>


<body>
  
    <!-- Menú de pestañas -->
    <div class="tab-container">
        <?php 
        $urls = [
            'pagina1.php', // URL para la pestaña 1
            'pagina2.php', // URL para la pestaña 2
            'pagina3.php', // URL para la pestaña 3
            'pagina4.php', // URL para la pestaña 4
            'pagina5.php', // URL para la pestaña 5
            'pagina6.php', // URL para la pestaña 6
            'pagina7.php', // URL para la pestaña 7
            'pagina8.php', // URL para la pestaña 8
            

        ];

        for ($i = 1; $i <= 8; $i++): ?>
            <div class="tab<?php echo $i === 1 ? ' active' : ''; ?>" onclick="loadContent('<?php echo $urls[$i-1]; ?>')">
                <?php echo isset($nombres[$i-1]) ? htmlspecialchars($nombres[$i-1]) : "Pestaña $i"; ?>
            </div>
        <?php endfor; ?>
    
         <div class="settings-tab">
            <a href="/pages/guion/configuracion.php"><i class="fas fa-cog"></i></a>
        </div>

    <!-- Contenedor para el contenido dinámico -->
   <div id="dynamic-content" class="content active">
    <p>Selecciona una pestaña para ver el contenido.</p>
</div>



<script src="/assets/js/principal.js"></script> <!-- Controla los menus -->

</body>
</html>

   <!-- HASTA AQUI LLEGA EL CONTROL + Z -->
