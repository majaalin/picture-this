<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>

    <?php if (isset($_SESSION['user'])) :?>
    <p><?php echo "Welcome, " . $_SESSION['user']['full_name'] . "!"; ?> </p>
    <img src="/uploads/<?php echo $_SESSION['user']['avatar']; ?>" alt="">
    <button><a href="/profile.php">Edit profil</a></button>
    <?php endif; ?>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
