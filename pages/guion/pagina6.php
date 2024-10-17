<?php
session_start(); // Iniciar sesión para acceder a la información del usuario

require '/home/ziriuson/public_html/includes/db.php'; // Conexión a la base de datos

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirigir a inicio de sesión si no está autenticado
    exit();
}

// Suponiendo que ya tienes la sesión iniciada y $userId es el ID del usuario logueado
$userId = $_SESSION['user_id'];

// Obtener los párrafos específicos del usuario de la base de datos
$sql = "SELECT p.id, COALESCE(up.content, p.content) AS content FROM pagina6 p  
        LEFT JOIN user_pagina6 up ON p.id = up.pagina6_id AND up.user_id = :userId";
$stmt = $pdo->prepare($sql);
$stmt->execute(['userId' => $userId]);
$paragraphs = $stmt->fetchAll(); // Obtener todos los párrafos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/css/guion/paginas.css">
        <title>Guiones</title>
</head>
    <body>
   <div class="content-wrapper">
    <?php
    // Mostrar cada párrafo en la interfaz
    foreach ($paragraphs as $para) {
        echo '<div class="paragraph-box" id="para' . $para['id'] . '">';
        echo '<p>' . htmlspecialchars($para['content']) . '</p>';
        echo '<div class="button-group">'; // Nuevo contenedor para los botones
        echo '<button class="copy-btn" onclick="copyText(\'para' . $para['id'] . '\')">Copiar</button>';
        echo '<button class="edit-btn" onclick="openEditModal(' . $para['id'] . ')">Modificar</button>';
        echo '</div>'; // Cierre del contenedor de botones
        echo '</div>';
    }
    ?>
</div>

    <!-- Modal para editar párrafos -->
    <div id="editModal6"> <!-- Cambiado a editModal3 -->
        <div class="modal-content">
            <span class="close-btn" onclick="closeEditModal()">&times;</span>
            <h2>Editar Párrafo</h2>
            <textarea id="editText6" rows="4" style="width: 100%;"></textarea> <!-- Cambiado a editText3 -->
            <button id="saveChanges6" onclick="saveParagraph()">Guardar</button> <!-- Cambiado a saveChanges3  -->
        </div>
    </div>

    <script>
        let currentParaId = null;

        // Función para copiar texto al portapapeles
        function copyText(paraId) {
            const textContent = document.getElementById(paraId).getElementsByTagName('p')[0].innerText;
            navigator.clipboard.writeText(textContent).then(() => {
                alert("Texto copiado al portapapeles!");
            }).catch(err => {
                console.error('Error al copiar el texto: ', err);
            });
        }

        // Abre el modal para editar el párrafo
        function openEditModal6(paraId) {
            currentParaId = paraId;
            const textElement = document.getElementById('para6' + paraId).getElementsByTagName('p')[0]; // Cambiado a para2
            document.getElementById('editText6').value = textElement.innerText; // Rellena el textarea
            document.getElementById('editModal6').style.display = "block"; // Muestra el modal
        }

        // Cierra el modal
        function closeEditModal() {
            document.getElementById('editModal6').style.display = "none"; // Oculta el modal
        }

        // Guarda el texto editado
        function saveParagraph() {
            const updatedText = document.getElementById('editText6').value; // Cambiado a editText2
            const textElement = document.getElementById('para6' + currentParaId).getElementsByTagName('p')[0]; // Cambiado a para2
            textElement.innerText = updatedText; // Actualiza el párrafo en la interfaz

            // Envía la nueva información al servidor
            fetch('update_pagina6.php', { // Cambiado a update_pagina2.php
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + currentParaId + '&content=' + encodeURIComponent(updatedText)
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Para depuración
            })
            .catch(error => console.error('Error:', error));

            closeEditModal(); // Cierra el modal
        }

        // Función para confirmar la eliminación del párrafo
        function confirmRemoval(paraId) {
            if (confirm("¿Estás seguro de que deseas eliminar este párrafo?")) {
                deleteParagraph(paraId);
            }
        }

        
    </script>
</body>
</html>
