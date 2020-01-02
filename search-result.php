<?php require __DIR__.'/views/header.php'; ?>
<a href="/search.php"><img src="/back.png" alt="" class="back"></a>

<?php 
$statement = $pdo->prepare('SELECT * FROM users');

$statement->execute();

$diffrentUsers = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<article>

<form class="search" action="/app/users/search.php" method="get">
<input class="form-control" type="text" name="search" placeholder="Search"> 
</form>

<?php foreach ($users as $user) : ?>
    <a class="search-user" href="/my-posts.php">
    <?php if ($user['avatar'] === NULL): ?>
        <img class="avatar" src="/no-image.png" alt="">
        <p><?php echo $user['username'] ?></p>
        <p><?php echo $user['full_name'] ?></p>
        <?php else : ?>
            <img class="avatar" src="/uploads/<?php echo $user['avatar'] ?>" alt="">
            <p><?php echo $user['username'] ?></p>
            <p><?php echo $user['full_name'] ?></p>
    <?php endif; ?>
    </a>
<?php endforeach ?>

<?php foreach ($diffrentUsers as $diffrentUser) : ?>
    <a class="search-user" href="/my-posts.php">
    <?php if ($diffrentUser['avatar'] === NULL): ?>
        <img class="avatar" src="/no-image.png" alt="">
        <p><?php echo $diffrentUser['username'] ?></p>
        <p><?php echo $diffrentUser['full_name'] ?></p>
        <?php else : ?>
            <img class="avatar" src="/uploads/<?php echo $diffrentUser['avatar'] ?>" alt="">
            <p><?php echo $diffrentUser['username'] ?></p>
            <p><?php echo $diffrentUser['full_name'] ?></p>
    <?php endif; ?>
</a>
<?php endforeach ?>

</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>
