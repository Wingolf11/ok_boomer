<?php
require 'config/data_b.php';

// Make sure user is logged in
$sessionUserId = $_SESSION['id_user'] ?? null;
$sessionUserRole = $_SESSION['role'] ?? null;

// Prepare and execute query
$myquery = $conn->prepare("
    SELECT users.*, roles.libelle_role
    FROM users 
    JOIN roles ON users.id_role = roles.id_role
");
$myquery->execute();
$result = $myquery->get_result();

if (!$result) {
    die('Erreur lors de la requête : ' . $conn->error);
}

// Display results
echo "<table class='table' border='1' cellpadding='5' cellspacing='0'>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . htmlspecialchars($row['login']) . "</td>
        <td>" . nl2br(htmlspecialchars($row['id_role'])) . "</td>
        <td>" . htmlspecialchars($row['create_at']) . "</td>" ;

    // Check role-based delete permission
    $canDelete = false;

    if ($sessionUserRole === 'superadmin' || $sessionUserRole === 'admin') {
        $canDelete = true;
    }

    if ($canDelete) {
        echo "<td>
                <form method='post' action='delete_user.php' onsubmit='return confirm(\"Supprimer cet utilisateur ?\");'>
                    <input type='hidden' name='id_user' value='" . $row['id_user'] . "'>
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

