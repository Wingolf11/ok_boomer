<?php
require 'config/data_b.php';

// Execute the query
$myquery = $conn->prepare("SELECT * FROM articles");
$myquery->execute();
$result = $myquery->get_result();

// Check for query failure
if (!$result) {
    die('Erreur lors de la requête : ' . $conn->error);
}

// Display the table
echo "
<table class='table' border='1' cellpadding='10' cellspacing='0'>
    <tr>
        <th>Titre</th>
        <th>Date</th>
        <th>Photo</th>
        <th>Texte</th>
        <th>ID Utilisateur</th>
    </tr>";

// Loop through the results
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . htmlspecialchars($row['titre']) . "</td>
        <td>" . htmlspecialchars($row['date']) . "</td>
        <td><img src='" . htmlspecialchars($row['photo']) . "' alt='Photo' width='100'></td>
        <td>" . nl2br(htmlspecialchars($row['texte'])) . "</td>
        <td>" . htmlspecialchars($row['id_user']) . "</td>
    </tr>";
}

echo "</table>";

// Close the statement and connection
$myquery->close();
$conn->close();
?>
