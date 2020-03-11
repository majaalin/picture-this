<?php require __DIR__.'/views/header.php'; ?>

<?php

// If user not logged in
if (!isset($_SESSION['user'])) {
    $errors[] = 'You need to login';
    $_SESSION['errors'] = $errors;
    redirect('/');
    exit;
}

// Get all users from database
$statement = $pdo->prepare('SELECT * FROM users');
$statement->execute();
$otherUsers = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<article class="search-result">
<h1>Search</h1>

<img src="/icons/back.png" alt="back" class="back" onclick="goBack()">

<form class="search" action="/app/users/search-results.php" method="get">
<input class="form-control" type="text" name="search" placeholder="Search"> 
</form>

<!-- View results from search -->
<?php foreach ($users as $user) { ?>
    <form class="search-user" action="/profile.php" method="GET">
    <button type="submit" name="user_id" value="<?php echo $user['user_id'] ?>">
    <?php if (!$user['avatar']) { ?>
        <img class="avatar" src="/images/no-avatar.png" alt="avatar">
        <?php } else { ?>
            <img class="avatar" src="/uploads/<?php echo $user['avatar'] ?>" alt="avatar">
    <?php } ?>
        <div class="name">
        <p class="username"><?php echo $user['username'] ?></p>
        <p><?php echo $user['full_name'] ?></p>
    </div>
    </button>
    </form>
<?php } ?>

<!-- View all other users -->
<?php foreach ($otherUsers as $otherUser) { ?>
    <form class="search-user" action="/profile.php" method="GET">
    <button type="submit" name="user_id" value="<?php echo $otherUser['user_id'] ?>">
    <?php if (!$otherUser['avatar']) { ?>
        <img class="avatar" src="/images/no-avatar.png" alt="avatar">
        <?php } else { ?>
            <img class="avatar" src="/uploads/<?php echo $otherUser['avatar'] ?>" alt="avatar">
    <?php } ?>
        <div class="name">
        <p class="username"><?php echo $otherUser['username'] ?></p>
        <p><?php echo $otherUser['full_name'] ?></p>
        </div>
        </button>
        </form>
<?php } ?>

</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>
