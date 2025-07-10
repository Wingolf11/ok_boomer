<?php
session_start();
require 'config/data_b.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre']);
    $texte = trim($_POST['texte']);
    $id_user = $_SESSION['id_user']; // Fixed user ID
    $date = date('Y-m-d H:i:s');

    // Predetermined photo path (replace with your actual default image)
    $photoPath = 'uploads/header_img.jpg';

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO articles (titre, date, photo, texte, id_user) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $titre, $date, $photoPath, $texte, $id_user);

    if ($stmt->execute()) {
        header("Location: dashboard.php");       
    } else {
        echo "Erreur lors de l'ajout : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Requête invalide.";
}
