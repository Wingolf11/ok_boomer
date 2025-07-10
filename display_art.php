<?php
session_start();
require 'config/data_b.php';

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

echo "<table class='table' cellpadding='5' cellspacing='0'>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td><img src='" . htmlspecialchars($row['photo']) . "' alt='Photo' width='200'></td>
        <td>" . htmlspecialchars($row['titre']) . "</td>
        <td>" . nl2br(htmlspecialchars($row['texte'])) . "</td>
        <td>" . htmlspecialchars($row['date']) . "</td>
        <td>" . htmlspecialchars($row['login']) . "</td>
    </tr>";
}
echo "</table>";

$myquery->close();
$conn->close();
?>
