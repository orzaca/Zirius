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
$sql = "SELECT p.id, COALESCE(up.content, p.content) AS content FROM pagina1 p 
        LEFT JOIN user_pagina1 up ON p.id = up.pagina1_id AND up.user_id = :userId";
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
    <div id="editModal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeEditModal()">&times;</span>
            <h2>Editar Guiones</h2>
            <textarea id="editText" rows="4" style="width: 100%;"></textarea>
            <button id="saveChanges" onclick="saveParagraph()">Guardar</button>
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
        function openEditModal(paraId) {
            currentParaId = paraId;
            const textElement = document.getElementById('para' + paraId).getElementsByTagName('p')[0];
            document.getElementById('editText').value = textElement.innerText; // Rellena el textarea
            document.getElementById('editModal').style.display = "block"; // Muestra el modal
        }

        // Cierra el modal
        function closeEditModal() {
            document.getElementById('editModal').style.display = "none"; // Oculta el modal
        }

        // Guarda el texto editado
        function saveParagraph() {
            const updatedText = document.getElementById('editText').value;
            const textElement = document.getElementById('para' + currentParaId).getElementsByTagName('p')[0];
            textElement.innerText = updatedText; // Actualiza el párrafo en la interfaz

            // Envía la nueva información al servidor
            fetch('update_pagina1.php', {
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

        // Función para eliminar el párrafo
        function deleteParagraph(paraId) {
            fetch('delete_paragraph_pagina1.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + paraId
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById('para' + paraId).remove(); // Elimina el párrafo de la interfaz
                    alert("Párrafo eliminado con éxito.");
                } else {
                    alert("Error al eliminar el párrafo.");
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
