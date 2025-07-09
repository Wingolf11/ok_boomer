<?php
session_start();
require 'data_b.php';

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




<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Connexion</title>
        <link rel="stylesheet" href="style/login_style.css" />
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
                    <input type="text" id="login" name="login" placeholder="Indentifiant" maxlength="20" required>
                    
                    <br>
                    <br>

                    <label for="PW">Mot de passe:</label>
                    <input type="password" id="PW" name="PW" placeholder="Mot de passe" maxlength="20" required>

                    <br>
                    <br>

                    <button type="submit" name="sub" id="login_btn">S'identifier</button>
                </form>
                <a href="signup.php" class="signup_btn"><button id="signup_btn">Créer un compte</button></a>
            </div>
        </section>
    </body>
</html>