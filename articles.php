<?php
require 'data_b.php';

$sql = "SELECT a.id_article, a.titre, a.date, a.photo, a.texte, u.login 
        FROM articles a 
        JOIN users u ON a.id_user = u.id_user 
        ORDER BY a.date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
        $date = new DateTime($row["date"]);
?>
        <article class="article">
            <h2><?php echo htmlspecialchars($row["titre"]); ?></h2>
            <small class="article-date">
                Publié le: 
                <time datetime="<?php echo htmlspecialchars($row['date']); ?>">
                    <?php echo $date->format('d/m/Y'); ?>
                </time>
            </small>
            <?php if (!empty($row["photo"])): ?>
                <img src="uploads/<?php echo htmlspecialchars($row["photo"]); ?>" alt="Image pour <?php echo htmlspecialchars($row["titre"]); ?>" style="max-width: 100%; height: auto;">
            <?php endif; ?>
            <p><?php echo nl2br(htmlspecialchars($row["texte"])); ?></p>
            <small class="author">Auteur: <?php echo htmlspecialchars($row["login"]); ?></small>
        </article>
<?php
    endwhile;
else:
    echo "<p>Aucun article trouvé.</p>";
endif;

$conn->close();
?>
