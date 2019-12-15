<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Register</h1>

    <?php foreach ($errors as $error) : ?>
        <p><?php echo $error ?></p>
    <?php endforeach ?>

    <form action="app/users/register.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email">
            <small class="form-text text-muted">Please provide the your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="name">Username</label>
            <input class="form-control" type="text" name="username">
            <small class="form-text text-muted">Please provide the your username.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="name">Full name</label>
            <input class="form-control" type="text" name="full_name">
            <small class="form-text text-muted">Please provide the your full name.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide the your password.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Confirm password</label>
            <input class="form-control" type="password" name="confirm_password" required>
            <small class="form-text text-muted">Please confirm your password.</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Create a user</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>