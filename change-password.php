<?php require __DIR__.'/views/header.php'; ?>

<article>
<img src="/icons/back.png" alt="back" class="back" onclick="goBack()">

    <h1>Change password</h1>

    <form class="edit-profil-container" action="app/users/password.php" method="post">

    <div class="edit-profil-input">
            <label for="password">Old password</label>
            <input class="form-control" type="password" name="old_password" required>
        </div>

        <div class="edit-profil-input">
            <label for="password">New password</label>
            <input class="form-control" type="password" name="new_password" required>
        </div>

        <div class="edit-profil-input">
            <label for="password">Confirm new password</label>
            <input class="form-control" type="password" name="confirm_new_password" required>
        </div>

        <button type="submit" class="update-profile">Change password</button>
    </form>
</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>