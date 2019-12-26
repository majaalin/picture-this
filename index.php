<?php require __DIR__.'/views/header.php'; ?>

<?php 
$statement = $pdo->prepare('SELECT * FROM photos ORDER BY date_created DESC');

$statement->execute();

$photos = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<article>


    <?php if (isset($_SESSION['user'])) :?>
        <div class="login">
        <img src="logo.png" alt="logo" class="logo">
        <img class="avatar" src="/uploads/<?php echo $_SESSION['user']['avatar']; ?>" alt="">
        <p class="username"><?php echo $_SESSION['user']['username']; ?></p>
        <button><a href="/all-posts.php">Login</a></button>
        <p class="other-accont"><a href="/app/users/logout.php">Login with a diffrent account</a></p>
        <p class="account">Are you new on Picture this? <a href="/register.php" class="bold">Make an account</a></p>
        </div>
        <?php endif; ?>
    
        <?php if (!isset($_SESSION['user'])) :?>
            <form action="app/users/login.php" method="post" class="login">
            <img src="logo.png" alt="logo" class="logo">
    <div class="form-group">
        <input class="form-control" type="email" name="email" placeholder=" Email" required>
    </div><!-- /form-group -->

    <div class="form-group">
        <input class="form-control" type="password" name="password"  placeholder=" Password" required>
    </div><!-- /form-group -->

    <button type="submit">Login</button>
    <p class="account">Are you new on Picture this? <a href="/register.php" class="bold">Make an account</a></p>
        <?php endif; ?>
        </div>

        <?php foreach ($errors as $error) : ?>
        <li><?php echo $error ?></li>
    <?php endforeach ?>

    <ul>
    <?php foreach ($successes as $success) : ?>
        <li><?php echo $success ?></li>
    <?php endforeach ?>
    </ul>
    </article>

<?php require __DIR__.'/views/footer.php'; ?>