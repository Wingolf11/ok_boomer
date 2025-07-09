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
            <nav>
                <ul>
                    <li><a href="login_v1.html" title="S'identifier">S'identifier</a></li>
                    <li><a href="signup.html" title="Créer un utilisateur">Créer un utilisateur</a></li>
                </ul>
            </nav>
            <div id="header_img">
                <img src="uploads/header_img.jpg" alt="Header Image">
            </div>
            <div id="welcome">
                <h1>Ok Boomer!</h1> 
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero, quasi, quibusdam autem nemo vel expedita minus voluptatibus, enim laboriosam optio debitis nesciunt magnam atque nam ipsam. Ad sint quod dolor!</p>
            </div>
        </header>
        <section id="list_art">
            <?php include 'articles.php'; ?>
        </section>
        <footer>
            <p>&copy; 2025 Ok Boomer</p>
        </footer>
    </body>
</html>