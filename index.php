<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ok boomer</title>
    <link rel="stylesheet" href="style/index_style.css" />
    </head>
    <body>
        <header>
            <nav class= nav_btns>
                <ul>
                    <li>
                        <a href="login.php" title="S'identifier" class="button">
                            <div class="button2">S'identifier</div>
                        </a>
                    </li>
                    <li>
                        <a href="signup.php" title="Créer un utilisateur" class="button btn-black">
                            <div class="button2">Créer un utilisateur</div>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="header_img">
                <img src="uploads/header_img.jpg" alt="Header Image">
            </div>
            <div class="welcome">
                <h1>Ok Boomer!</h1> 
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero, quasi, quibusdam autem nemo vel expedita minus voluptatibus, enim laboriosam optio debitis nesciunt magnam atque nam ipsam. Ad sint quod dolor!</p>
            </div>
        </header>
        <section class="list_art">
            <?php include 'articles.php'; ?>
        </section>
        <footer>
            <p>&copy; 2025 Ok Boomer</p>
        </footer>
    </body>
</html>