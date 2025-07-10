<?php
require 'config/data_b.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = intval($_POST['id_user']);

    $stmt = $conn->prepare("DELETE FROM users WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
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