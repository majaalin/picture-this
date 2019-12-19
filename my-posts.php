<?php require __DIR__.'/views/header.php'; ?>

<?php 

$userId = $_SESSION['user']['user_id'];
$username = $_SESSION['user']['username'];

$statement = $pdo->prepare('SELECT * FROM photos WHERE user_id = :user_id ORDER BY  date_created DESC');

$statement->bindParam(':user_id', $userId, PDO::PARAM_STR);

$statement->execute();

$photos = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!$photos) {
    $errors[] = "You don't have any photos";
}

?>

<article>
    <a href="/..">Back</a>
    <h1>My posts</h1>

    <?php foreach ($errors as $error) : ?>
        <li><?php echo $error ?></li>
    <?php endforeach ?>

    <ul>
    <?php foreach ($successes as $success) : ?>
        <li><?php echo $success ?></li>
    <?php endforeach ?>
    </ul>

    

    <?php foreach ($photos as $photo) : ?>
    <p><?php echo $username . ":" ?></p>
    <img src="/uploads/images/<?php echo $photo['image']; ?>" alt="">
    <p><?php echo $photo['caption'];?></p>
    <p><?php echo $photo['date_created'];?></p>
    <form action="/edit-post.php" method="GET">
    <?php $photoId = $photo['photo_id'];?>
    <button type="submit" name="photo_id" value="<?php echo $photoId ?>">Edit post</button>
    </form>
    <?php endforeach ?>

</article>

<?php require __DIR__.'/views/footer.php'; ?>