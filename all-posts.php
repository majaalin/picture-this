<?php require __DIR__.'/views/header.php'; ?>
<?php require __DIR__.'/views/navigation-top.php'; ?>

<?php 
$statement = $pdo->prepare('SELECT * FROM photos ORDER BY date_created DESC');

$statement->execute();

$photos = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if (isset($_SESSION['user'])) :?>
<?php foreach ($photos as $photo) : ?>
    <?php endforeach ?>
    <?php endif; ?>
    </article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>