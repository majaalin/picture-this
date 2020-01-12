<?php require __DIR__.'/views/header.php'; ?>
<a href="/search.php"><img src="/back.png" alt="" class="back"></a>

<?php 
$statement = $pdo->prepare('SELECT * FROM users');

$statement->execute();

$diffrentUsers = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<article class="search-result">

<img src="/icons/back.png" alt="" class="back" onclick="goBack()">

<form class="search" action="/app/users/search.php" method="get">
<input class="form-control" type="text" name="search" placeholder="Search"> 
</form>

<?php foreach ($users as $user) : ?>
    <form class="search-user" action="/profile.php" method="GET">
    <button type="submit" name="user_id" value="<?php echo $user['user_id'] ?>">
    <?php if ($user['avatar'] === NULL): ?>
        <img class="avatar" src="/images/" alt="">
        <div class="name">
        <p class="username"><?php echo $user['username'] ?></p>
        <p><?php echo $user['full_name'] ?></p>
    </div>
        <?php else : ?>
            <img class="avatar" src="/uploads/<?php echo $user['avatar'] ?>" alt="">
            <div class="name">
            <p class="username"><?php echo $user['username'] ?></p>
            <p><?php echo $user['full_name'] ?></p>
        </div>
    <?php endif; ?>
    </button>
    </form>
<?php endforeach ?>

<?php foreach ($diffrentUsers as $diffrentUser) : ?>
    <form class="search-user" action="/profile.php" method="GET">
    <button type="submit" name="user_id" value="<?php echo $diffrentUser['user_id'] ?>">
    <?php if ($diffrentUser['avatar'] === NULL): ?>
        <img class="avatar" src="/images/no-avatar.png" alt="">
        <div class="name">
        <p class="username"><?php echo $diffrentUser['username'] ?></p>
        <p><?php echo $diffrentUser['full_name'] ?></p>
        </div>
        <?php else : ?>
            <img class="avatar" src="/uploads/<?php echo $diffrentUser['avatar'] ?>" alt="">
            <div class="name">
            <p class="username"><?php echo $diffrentUser['username'] ?></p>
            <p><?php echo $diffrentUser['full_name'] ?></p>
            </div>
    <?php endif; ?>
        </button>
        </form>
<?php endforeach ?>


</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>
