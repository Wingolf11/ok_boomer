<?php
session_start();
require '../config/data_b.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['login']);
    $password = $_POST['PW'];

    // Fetch user and their role name
    $myquery = $conn->prepare("
        SELECT users.*, roles.libelle_role 
        FROM users 
        JOIN roles ON users.id_role = roles.id_role 
        WHERE users.login = ?
    ");
    $myquery->bind_param('s', $username);
    $myquery->execute();
    $result = $myquery->get_result();

    if ($user = $result->fetch_assoc()) {
        if ($password === $user['PW']) { 
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['id_role'] = $user['id_role'];
            $_SESSION['role'] = $user['libelle_role'];

            header("Location: ../dashboard.php");
            exit;
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Utilisateur non trouvé.";
    }
}
?>
