<?php
require 'config/data_b.php';

$stmt = $conn->prepare("SELECT a.id_article, a.titre, a.date, a.photo, a.texte, u.login 
                        FROM articles a 
                        JOIN users u ON a.id_user = u.id_user 
                        ORDER BY a.date DESC");
$stmt->execute();

$result = $stmt->get_result();

$articles = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
    // Successful response with articles
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'articles' => $articles
    ]);
} else {
    // No articles found — return JSON error message
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Aucun article trouvé.'
    ]);
}

$stmt->close();
$conn->close();
?>
