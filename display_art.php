<?php
session_start();
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
echo "<table class='table' cellpadding='5' cellspacing='0'>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td><img src='" . htmlspecialchars($row['photo']) . "' alt='Photo' width='200'></td>
        <td>" . htmlspecialchars($row['titre']) . "</td>
        <td>" . nl2br(htmlspecialchars($row['texte'])) . "</td>
        <td>" . htmlspecialchars($row['date']) . "</td>
        <td>" . htmlspecialchars($row['login']) . "</td>";

    // Check role-based delete permission
    $canDelete = false;

    if ($sessionUserRole === 'superadmin' || $sessionUserRole === 'admin') {
        $canDelete = true;
    } elseif ($sessionUserRole === 'editeur' && $sessionUserId == $row['id_user']) {
        $canDelete = true;
    }

    if ($canDelete) {
        echo "<td>
                <form method='post' action='delete_article.php' onsubmit='return confirm(\"Supprimer cet article ?\");'>
                    <input type='hidden' name='id_article' value='" . $row['id_article'] . "'>
                    <button type='submit' class='delete-btn'>Supprimer</button>
                </form>
              </td>";
    } else {
        echo "<td></td>";
    }

    echo "</tr>";
}
echo "</table>";

$myquery->close();
$conn->close();
?>

