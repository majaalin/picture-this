<article>

    <?php foreach ($errors as $error) : ?>
        <p><?php echo $error ?></p>
    <?php endforeach ?>

    <ul>
    <?php foreach ($successes as $success) : ?>
        <li><?php echo $success ?></li>
    <?php endforeach ?>
    </ul>

    <?php if (isset($_SESSION['user'])) :?>
        <div class="login">
        <img src="logo.png" alt="logo" class="logo">
        <img class="avatar" src="/uploads/<?php echo $_SESSION['user']['avatar']; ?>" alt="">
        <p class="username"><?php echo $_SESSION['user']['username']; ?></p>
        <button>Login</button>
        <p class="other-accont"><a href="">Login with a diffrent account</a></p>
        </div>
        <?php endif; ?>
    <article>

    <?php if (!isset($_SESSION['user'])) :?>

    <form action="app/users/login.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>
            <small class="form-text text-muted">Please provide the your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide the your password (passphrase).</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Login</button>

    </form>
    <a href="/register.php"><button class="btn btn-primary">New user</button></a>
    <?php endif; ?>
</article>
