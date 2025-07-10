<?php
require 'config/data_b.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_article = intval($_POST['id_article']);

    $stmt = $conn->prepare("DELETE FROM articles WHERE id_article = ?");
    $stmt->bind_param("i", $id_article);

    if ($stmt->execute()) {
        header("Location: index.php"); // or display.php or wherever you show articles
        exit;
    } else {
        echo "Erreur lors de la suppression : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Requête invalide.";
}
?>