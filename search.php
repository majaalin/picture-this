<?php require __DIR__.'/views/header.php'; ?>

<?php 
$statement = $pdo->prepare('SELECT * FROM photos ORDER BY date_created DESC');

$statement->execute();

$photos = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<article>

<form class="search" action="/app/users/search.php" method="get">
<input class="form-control" type="text" name="search" placeholder="Search"> 
</form>

<div class="container">
<?php if (isset($_SESSION['user'])) :?>
<?php foreach ($photos as $photo) : ?>
    <img class="small-image" src="/uploads/images/<?php echo $photo['image']; ?>" alt="">
    
    <?php endforeach ?>
    <?php endif; ?>
    </div>

</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>
