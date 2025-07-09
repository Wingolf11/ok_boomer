<?php
session_start();
require 'data_b.php';

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
            
            // Hash password
            $hashed_pw = password_hash($password, PASSWORD_DEFAULT);

            // Insert user
            $stmt = $conn->prepare("INSERT INTO users (login, PW, id_role, create_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param('ssi', $login, $hashed_pw, $role_id);

            if ($stmt->execute()) {
                header("Location: login.php");
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



<!DOCTYPE html>
<html>
        <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>S'inscrire</title>
        <link rel="stylesheet" href="style/signup_style.css"/>
    </head>
    <body>
        <section id="signup">
            <div>
                <h1>S'inscrire</h1>
                <form method="post">
                    <label for="login">Identifiant</label>
                    <input type="text" name="login" placeholder="Identifiant" required>
                    <br>
                    <br>
                    <label for="PW">Mot de passe</label>
                    <input type="password" name="PW" placeholder="Mot de passe" required>
                    <br>
                    <br>
                    <label for="libelle_role">Role</label>
                    <select id="libelle_role" name="libelle_role" required>
                        <option valuer="" selected>Choisissez un rôle</option>
                        <option value="superadmin">Super admin</option>
                        <option value="admin">Admin</option>
                        <option value="editeur">Editeur</option>
                        <option value="lecteur">Lecteur</option>
                    </select>
                    <br>
                    <br>
                    <button type="submit" name="sub">S'inscrire</button>
                </form>
                <a href="login.php" calss="go_login" title="Revenir sur l'identification"><button id="login_btn">S'identifier</button></a>
            </div>
        </section>
    </body>
</html>