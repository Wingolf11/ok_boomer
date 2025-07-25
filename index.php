<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Ok Boomer</title>
<link rel="stylesheet" href="CSS/index.css">
</head>
<body>

<header>
  <nav class="nav_btns">
    <button class="button" data-modal="articleModal">AJOUTER UN ARTICLE</button>
    <button class="button" data-modal="loginModal">S'IDENTIFIER</button>
  </nav>
<div class="header_img">
  <img src="uploads/header_img.jpg" alt="Header Image">
  <div class="welcome">
    <h1>Ok Boomer!</h1> 
      <p class="text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero, quasi, quibusdam autem nemo vel expedita minus voluptatibus, enim laboriosam optio debitis nesciunt magnam atque nam ipsam. Ad sint quod dolor!</p>
  </div>
</div>
</header>
<section class="list_art" id="article-container">
  <?php include 'display/display_art.php'; ?>
</section>

<footer>
  <p>&copy; 2025 Ok Boomer</p>
</footer>

  <!-- Modals -->
  <div class="modal-overlay" id="modalOverlay">
    <div class="modal" id="articleModal">
      <span class="close-btn">&times;</span>
      <h2>Ajouter un article</h2>
      <form action="handlers/add_article.php" method="post" enctype="multipart/form-data">
        <input type="text" name="titre" placeholder="Titre" required>
        <textarea name="texte" placeholder="Contenu de l'article" required></textarea>
        <label for="photo" id="photo label">Choisissez un fichier:</label>
        <input type="file" name="photo" id="photo_input">
        <button type="submit">Publier</button>
      </form>
    </div>

    <div class="modal" id="loginModal">
      <span class="close-btn">&times;</span>
      <h2>Connexion</h2>
      <form action="handlers/login.php" method="post">
        <input type="text" name="login" placeholder="Nom d'utilisateur" required>
        <input type="password" name="PW" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
      </form>
    </div>
  </div>

  <script src="JS/modals.js"></script>

</body>
</html>