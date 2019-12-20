<?php require __DIR__.'/views/header.php'; ?>

<?php 
$statement = $pdo->prepare('SELECT * FROM photos ORDER BY  date_created DESC');

$statement->execute();

$photos = $statement->fetchAll(PDO::FETCH_ASSOC);

?>


<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>

    <?php if (isset($_SESSION['user'])) :?>
    <p><?php echo "Welcome, " . $_SESSION['user']['full_name'] . "!"; ?> </p>
    <img src="/uploads/<?php echo $_SESSION['user']['avatar']; ?>" alt="">
    <button><a href="/profile.php">Edit profil</a></button>
    <button><a href="/posts.php">New post</a></button>
    <button><a href="/my-posts.php">My post</a></button>
    <?php endif; ?>
    <form action="users.php" method="GET">
    <input id="search" type="text" placeholder="Search for username">
    <input id="submit" type="submit" value="Search">
</article>

<article>
<?php foreach ($photos as $photo) : ?>
    <img src="/uploads/images/<?php echo $photo['image']; ?>" alt="">
    <p><?php echo $photo['caption'];?></p>
    <p><?php echo $photo['date_created'];?></p>
    <form action="/app/posts/like.php" method="GET">
    <?php $photoId = $photo['photo_id'];?>
    <button type="submit" name="photo_id" value="<?php echo $photoId ?>">Like post</button>
    </form>
    <?php endforeach ?>
    </article>

<?php require __DIR__.'/views/footer.php'; ?>
