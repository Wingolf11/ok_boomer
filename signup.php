<?php
session_start();
require 'config/data_b.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['PW'];
    $libelle_role = $_POST['libelle_role'];

    // Check if user already exists
    $check = $conn->prepare("SELECT * FROM users WHERE login = ?");
    $check->bind_param('s', $login);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {
        $error = "Ce nom d'utilisateur est déjà pris.";
    } else {
        // Get role ID from roles table
        $role_stmt = $conn->prepare("SELECT id_role FROM roles WHERE libelle_role = ?");
        $role_stmt->bind_param('s', $libelle_role);
        $role_stmt->execute();
        $role_result = $role_stmt->get_result();

        if ($role = $role_result->fetch_assoc()) {
            $role_id = $role['id_role'];
            
            // Insert user
            $stmt = $conn->prepare("INSERT INTO users (login, PW, id_role, create_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param('ssi', $login, $password, $role_id);

            if ($stmt->execute()) {
                header("Location: index.php");
                exit;
            } else {
                $error = "Une erreur est survenue lors de l'inscription.";
            }
        } else {
            $error = "Rôle invalide sélectionné.";
        }
    }
}
?>