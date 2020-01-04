<?php require __DIR__.'/views/header.php'; ?>

<?php 
$statement = $pdo->prepare('SELECT * FROM photos ORDER BY date_created DESC');

$statement->execute();

$photos = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<article>

<img src="/icons/back.png" alt="" class="back" onclick="goBack()">

<form class="search" action="/app/users/search.php" method="get">
<input class="form-control" type="text" name="search" placeholder="Search for a user"> 
</form>

<div class="container">
<?php if (isset($_SESSION['user'])) :?>
<?php foreach ($photos as $photo) : ?>
    <form action="/post.php" method="GET">
    <button type="submit" name="photo_id" value="<?php echo $photo['photo_id'] ?>">
    <img class="small-image" src="/uploads/images/<?php echo $photo['image']; ?>" alt="">
    </button>
    </form>
    <?php endforeach ?>
    <?php endif; ?>
    </div>

</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>
