<?php require __DIR__.'/views/header.php'; ?>

<?php

// Get all photos from all users

// If user not logged in
if (!isset($_SESSION['user'])) {
    $errors[] = "You need to login";
    $_SESSION['errors'] = $errors;
    redirect("/");
    exit;
}

$statement = $pdo->prepare('SELECT * FROM photos ORDER BY date_created DESC');
$statement->execute();
$photos = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<article>
<img src="/icons/back.png" alt="back" class="back" onclick="goBack()">

<h1>Search</h1>

<form class="search" action="/app/users/search-results.php" method="get">
<input class="form-control" type="text" name="search" placeholder="Search for a user"> 
</form>

<main>
<div class="container">
<?php if (isset($_SESSION['user'])) :?>
<?php foreach ($photos as $photo) : ?>
    <form action="/post.php" method="GET">
    <button type="submit" name="photo_id" value="<?php echo $photo['photo_id'] ?>">
    <img class="small-image" src="/uploads/<?php echo $photo['image']; ?>" alt="small-image">
    </button>
    </form>
    <?php endforeach ?>
    <?php endif; ?>
    </div>
</main>

</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>
