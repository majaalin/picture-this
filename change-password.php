<?php require __DIR__.'/views/header.php'; ?>

<article>
<img src="/icons/back.png" alt="" class="back" onclick="goBack()">

    <h1>Change password</h1>

    <?php foreach ($errors as $error) : ?>
        <p><?php echo $error ?></p>
    <?php endforeach ?>

    <ul>
    <?php foreach ($successes as $success) : ?>
        <li><?php echo $success ?></li>
    <?php endforeach ?>
    </ul>

    <form class="edit-profil-container" action="app/users/password.php" method="post">

    <div class="edit-profil-input">
            <label for="password">Old password</label>
            <input class="form-control" type="password" name="old_password" required>
        </div><!-- /form-group -->

        <div class="edit-profil-input">
            <label for="password">New password</label>
            <input class="form-control" type="password" name="new_password" required>
        </div><!-- /form-group -->

        <div class="edit-profil-input">
            <label for="password">Confirm new password</label>
            <input class="form-control" type="password" name="confirm_new_password" required>
        </div><!-- /form-group -->

        <button type="submit" class="update-profile">Change password</button>
    </form>
</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>