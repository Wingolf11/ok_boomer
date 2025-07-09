<?php
session_start();
require 'data_b.php';

header('Content-Type: application/json');

// Check if the user is logged in
if (!isset($_SESSION['id_user'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Vous devez être connecté pour ajouter un article.'
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Méthode non autorisée.'
    ]);
    exit;
}

// Get form data and sanitize
$titre = trim($_POST['titre'] ?? '');
$texte = trim($_POST['texte'] ?? '');
$date = $_POST['date'] ?? date('Y-m-d'); // default to today
$photo = $_POST['photo'] ?? null;
$id_user = $_SESSION['id_user'];

// Validate required fields
if (empty($titre) || empty($texte)) {
    echo json_encode([
        'success' => false,
        'message' => 'Le titre et le texte sont obligatoires.'
    ]);
    exit;
}

// Insert into database
if ($photo) {
    $stmt = $conn->prepare("INSERT INTO articles (titre, texte, date, photo, id_user) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssi', $titre, $texte, $date, $photo, $id_user);
} else {
    $stmt = $conn->prepare("INSERT INTO articles (titre, texte, date, id_user) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('sssi', $titre, $texte, $date, $id_user);
}

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Article ajouté avec succès.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de l\'ajout de l\'article.'
    ]);
}

$stmt->close();
$conn->close();
?>