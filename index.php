<?php require __DIR__.'/views/header.php'; ?>

<article>

    <!-- If user is inlogged -->
    <?php if (isset($_SESSION['user'])) :?>
        <div class="login">
        <img src="/images/logo.png" alt="logo" class="logo">
        <img class="avatar" src="/uploads/<?php echo $_SESSION['user']['avatar']; ?>" alt="">
        <p class="username"><?php echo $_SESSION['user']['username']; ?></p>
        <button><a href="/posts.php">Login</a></button>
        <p class="diffrent-account"><a href="/app/users/logout.php">Login with a diffrent account</a></p>
        <p class="new-account">Are you new on Picture this? <a href="/register.php" class="bold">Make an account</a></p>
        </div>
    <?php endif; ?>


    <!-- If user is not inlogged -->
    <?php if (!isset($_SESSION['user'])) :?>
        <form action="app/users/login.php" method="post" class="login">
            <img src="/images/logo.png" alt="logo" class="logo">
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder=" Email" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password"  placeholder=" Password" required>
            </div>
            <button type="submit">Login</button>
            <p class="new-account">Are you new on Picture this? <a href="/register.php" class="bold">Make an account</a></p>
        </form>
    <?php endif; ?>
</article>

