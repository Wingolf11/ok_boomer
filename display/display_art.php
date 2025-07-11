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
echo "<table class='table' cellpadding='5' cellspacing='10'>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td id='photo'><img src='" . htmlspecialchars($row['photo']) . "' alt='Photo' width='200'></td>
        <td id='titre'>" . htmlspecialchars($row['titre']) . "</td>
        <td id='texte'>" . nl2br(htmlspecialchars($row['texte'])) . "</td>
        <td id='date'>" . htmlspecialchars($row['date']) . "</td>
        <td id='login'>" . htmlspecialchars($row['login']) . "</td>";

    // Check role-based delete permission
    $canDelete = false;

    if ($sessionUserRole === 'superadmin' || $sessionUserRole === 'admin') {
        $canDelete = true;
    } elseif ($sessionUserRole === 'editeur' && $sessionUserId == $row['id_user']) {
        $canDelete = true;
    }

    if ($canDelete) {
        echo "<td id='delete_btn'>
                <form method='post' action='handlers/delete_article.php' onsubmit='return confirm(\"Supprimer cet article ?\");'>
                    <input type='hidden' name='id_article' value='" . $row['id_article'] . "'>
                    <button class='button' type='submit' class='delete-btn'>Supprimer</button>
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

