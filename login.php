<article>

    <?php if (isset($_SESSION['user'])) :?>
        <div class="login">
        <img src="logo.png" alt="logo" class="logo">
        <img class="avatar" src="/uploads/<?php echo $_SESSION['user']['avatar']; ?>" alt="">
        <p class="username"><?php echo $_SESSION['user']['username']; ?></p>
        <button><a href="/all-posts.php">Login</a></button>
        <p class="other-accont"><a href="/login-new.php">Login with a diffrent account</a></p>
        <p class="account">Are you new on Picture this? <a href="/register.php" class="bold">Make an account</a></p>
        </div>
        <?php endif; ?>
    <article>
