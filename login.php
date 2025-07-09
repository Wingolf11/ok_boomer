<?php
session_start();
require 'data_b.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['login']);
    $password = $_POST['PW'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['PW'])) {
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




<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Connexion</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <section id="log_form">
            <div>
                <h1>S'identifier</h1>

                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($error)): ?>
                    <p class="error-message"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>

                <form method="post">
                    <label for="login">Indentifiant: </label>
                    <input type="text" id="login" name="login" placeholder="Indentifiant" mamaxlength="20" required>
                    
                    <br>
                    <br>

                    <label for="PW">Mot de passe:</label>
                    <input type="password" id="PW" name="PW" placeholder="Mot de passe" maxlength="20" required>

                    <br>
                    <br>

                    <button type="submit" name="sub">S'identifier</button>
                    <a href="signup.php" class="secondary_btn" target=self>Créer un compte</a>
                </form>
            </div>
        </section>
    </body>
</html>