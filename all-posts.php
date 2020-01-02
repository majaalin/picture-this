<?php require __DIR__.'/views/header.php'; ?>
<?php require __DIR__.'/views/navigation-top.php'; ?>

<?php 
$statement = $pdo->prepare('SELECT * FROM photos ORDER BY date_created DESC');

$statement->execute();

$photos = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if (isset($_SESSION['user'])) :?>
<?php foreach ($photos as $photo) : ?>
    <div class="post">
    <div class="image-container">
    <img class="image" src="/uploads/images/<?php echo $photo['image']; ?>" alt="">
    </div>
    <form action="/app/posts/like.php" method="GET">
    <?php $photoId = $photo['photo_id'];?>
    <button id="heart" type="submit" name="photo_id" value="<?php echo $photoId ?>"><img class="heart" onclick="lik"src="like.png" alt=""></button>
    </form>
    <div class="caption-container">
    <span class="username">hej</span> 
    <span class="caption"><?php echo $photo['caption'];?></span>
    </div>
    <p class="date"><?php echo $photo['date_created'];?></p>
    <?php endforeach ?>
    <?php endif; ?>
    </article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>