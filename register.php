<?php require __DIR__.'/views/header.php'; ?>


<article>

    <div class="login">
    <a href="/"><img src="/back.png" alt="" class="back"></a>
        <h1>Create an account</h1>
    <form action="app/users/register.php" method="post">
        <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder=" Email">
        </div><!-- /form-group -->

        <div class="form-group">
            <input class="form-control" type="text" name="username" placeholder=" Username">
        </div><!-- /form-group -->

        <div class="form-group">
            <input class="form-control" type="text" name="full_name" placeholder=" Full name">
        </div><!-- /form-group -->

        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder=" Password" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <input class="form-control" type="password" name="confirm_password" placeholder=" Confirm password" required>
        </div><!-- /form-group -->

        <button type="submit">Create a user</button>
    </form>
    </div>
</article>

<?php require __DIR__.'/views/footer.php'; ?>