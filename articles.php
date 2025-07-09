<?php
require 'data_b.php';

// Fetch articles
$sql = "SELECT id_article, titre, date, photo, texte, id_user FROM articles ORDER BY date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
?>
        <article class="article">
            <h2><?php echo htmlspecialchars($row["titre"]); ?></h2>
            <small class="article-date">Publié le: <?php echo htmlspecialchars($row["date"]); ?></small>
            <?php if (!empty($row["photo"])): ?>
                <img src="<?php echo htmlspecialchars($row["photo"]); ?>" alt="Image pour <?php echo htmlspecialchars($row["titre"]); ?>" style="max-width: 100%; height: auto;">
            <?php endif; ?>
            <p><?php echo nl2br(htmlspecialchars($row["texte"])); ?></p>
            <small class="author">Auteur ID: <?php echo htmlspecialchars($row["id_user"]); ?></small>
        </article>
<?php
    endwhile;
else:
    echo "<p>Aucun article trouvé.</p>";
endif;

$conn->close();
?>
