<?php
session_start();
require 'config/data_b.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['login']);
    $password = $_POST['PW'];

    $myquery = $conn->prepare("SELECT * FROM users WHERE login = ?");
    $myquery->bind_param('s', $username);
    $myquery->execute();
    $result = $myquery->get_result();

    if ($user = $result->fetch_assoc()) {
        if ($password === $user['PW']) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['login'] = $user['login'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Utilisateur non trouvé.";
    }
}
?>