<?php
session_start(); // Iniciar sesión para acceder a la información del usuario

require '/home/ziriuson/public_html/includes/db.php'; // Conexión a la base de datos

// Suponiendo que ya tienes la sesión iniciada y $userId es el ID del usuario logueado
$userId = $_SESSION['user_id'];

// Obtener los párrafos específicos del usuario de la base de datos
$sql = "SELECT p.id, COALESCE(up.content, p.content) AS content FROM paragraphs p 
LEFT JOIN user_paragraphs up ON p.id = up.paragraph_id AND up.user_id = :userId";
$stmt = $pdo->prepare($sql);
$stmt->execute(['userId' => $userId]);
$paragraphs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/assets/css/guion/paginas.css">
    <link rel="stylesheet" href="/assets/css/guion/editmodal.css">
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

    <!-- Modal -->
    <div id="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Modificar Guion</h2>
            <textarea id="modalText" rows="4" style="width: 100%;"></textarea>
            <button id="saveButton" onclick="saveText()">Guardar</button>
        </div>
    </div>

    <script>


        let currentParagraphId = null;

        function copyToClipboard(paragraphId) {
            const paragraphText = document.getElementById(paragraphId).getElementsByTagName('p')[0].innerText;
            navigator.clipboard.writeText(paragraphText).then(() => {
                alert("¡Texto copiado al portapapeles!");
            }).catch(err => {
                console.error('Error al copiar el texto: ', err);
            });
        }
//Abre el modal para modificar guion
        function openModal(paragraphId) {
            currentParagraphId = paragraphId;
            const textElement = document.getElementById('paragraph' + paragraphId).getElementsByTagName('p')[0];
            document.getElementById('modalText').value = textElement.innerText; // Rellena el textarea con el texto actual
            document.getElementById('modal').style.display = "block"; // Muestra el modal
        }

        function closeModal() {
            document.getElementById('modal').style.display = "none"; // Oculta el modal
        }

        function saveText() {
            const newText = document.getElementById('modalText').value;
            const textElement = document.getElementById('paragraph' + currentParagraphId).getElementsByTagName('p')[0];
            textElement.innerText = newText;

            fetch('update_paragraph.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + currentParagraphId + '&content=' + encodeURIComponent(newText)
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Para depuración
            })
            .catch(error => console.error('Error:', error));

            closeModal();
        }


    </script> <!-- controla javascript de la pagina2 - guion-->
</body>
</html>
