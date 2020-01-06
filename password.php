<?php require __DIR__.'/views/header.php'; ?>

<article>
<img src="/icons/back.png" alt="" class="back" onclick="goBack()">

    <h1>Profile</h1>

    <?php foreach ($errors as $error) : ?>
        <p><?php echo $error ?></p>
    <?php endforeach ?>

    <ul>
    <?php foreach ($successes as $success) : ?>
        <li><?php echo $success ?></li>
    <?php endforeach ?>
    </ul>

    <form action="app/users/password.php" method="post">

    <div class="form-group">
            <label for="password">Old password</label>
            <input class="form-control" type="password" name="old_password" required>
            <small class="form-text text-muted">Please provide your old password.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">New password</label>
            <input class="form-control" type="password" name="new_password" required>
            <small class="form-text text-muted">Please provide your new password.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Confirm new password</label>
            <input class="form-control" type="password" name="confirm_new_password" required>
            <small class="form-text text-muted">Please confirm your new password.</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Change password</button>
    </form>
</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>