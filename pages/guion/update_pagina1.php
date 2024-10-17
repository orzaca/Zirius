<?php
session_start();
require '/home/ziriuson/public_html/includes/db.php'; // Conexión a la base de datos

// Verificar que el usuario esté autenticado
if (isset($_SESSION['user_id']) && isset($_POST['id']) && isset($_POST['content'])) {
    $userId = $_SESSION['user_id'];
    $paragraphId = $_POST['id'];
    $newContent = $_POST['content'];

    // Reemplazar el contenido del párrafo
    $sql = "REPLACE INTO user_pagina1 (user_id, pagina1_id, content) 
            VALUES (:userId, :paragraphId, :content)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'userId' => $userId,
            'paragraphId' => $paragraphId,
            'content' => $newContent
        ]);
        echo "Párrafo actualizado.";
    } catch (PDOException $e) {
        echo "Error al actualizar el párrafo: " . $e->getMessage(); // Captura el error y lo muestra
    }
} else {
    echo "No autorizado.";
}
?>

