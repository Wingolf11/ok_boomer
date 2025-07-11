<?php
require 'config/data_b.php';

// Make sure user is logged in
$sessionUserId = $_SESSION['id_user'] ?? null;
$sessionUserRole = $_SESSION['role'] ?? null;

// Prepare and execute query
$myquery = $conn->prepare("
    SELECT articles.*, users.login 
    FROM articles 
    JOIN users ON articles.id_user = users.id_user
");
$myquery->execute();
$result = $myquery->get_result();

if (!$result) {
    die('Erreur lors de la requête : ' . $conn->error);
}

// Display results
echo "<table class='table'>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td colspan='100%'>
        <div class='article-card'>
            <div class='card-photo'>
                <img src='" . htmlspecialchars($row['photo']) . "' alt='Photo'>
            </div>
            <div class='card-content'>
                <div class='card-header'>
                    <div class='card-title'>" . htmlspecialchars($row['titre']) . "</div>
                    <div class='card-meta'>
                        <div class='card-date'>" . htmlspecialchars($row['date']) . "</div>
                        <div class='card-author'>by " . htmlspecialchars($row['login']) . "</div>                
                    </div>
                </div>
                <div class='card-text'>" . nl2br(htmlspecialchars($row['texte'])) . "</div>";
    // Delete permission
    $canDelete = false;
    if ($sessionUserRole === 'superadmin' || $sessionUserRole === 'admin') {
        $canDelete = true;
    } elseif ($sessionUserRole === 'editeur' && $sessionUserId == $row['id_user']) {
        $canDelete = true;
    }

    if ($canDelete) {
        echo "<div class='card-delete'>
                <form method='post' action='handlers/delete_article.php' onsubmit='return confirm(\"Supprimer cet article ?\");'>
                    <input type='hidden' name='id_article' value='" . $row['id_article'] . "'>
                    <button class='delete_button' type='submit'>Supprimer</button>
                </form>
              </div>";
    }

    echo "</div></div></td></tr>";
}
echo "</table>";


$myquery->close();
$conn->close();
?>

