<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adding article</title>
    <link rel="stylesheet" href="" />
    </head>
    <body>
        <div class="out_ctn">
            <h3>Ajouter un article: </h3>            
            <div class="in_ctn">
                <form action="add_article.php" method="post" enctype="multipart/form-data">
                    <label for="titre">Titre:</label>
                    <input type="text" name="titre" required>
                    <br><br>

                    <label for="text">Contenu:</label>
                    <textarea name="texte" required></textarea>
                    <br><br>

                    <label for="photo">Ajouter une photo:</label>
                    <input type="file" name="photo">
                    <br><br>
                    
                    <button type="submit" class="button" name="sub">Ajouter</button>
                </form>
            </div>
        </div>
    </body>
</html>