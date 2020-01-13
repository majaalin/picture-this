<?php require __DIR__.'/views/header.php'; ?>

<article>
    <div class="login">
    <img src="/icons/back.png" alt="" class="back" onclick="goBack()">

    <h1>Create an account</h1>

    <form action="app/users/register.php" method="post">
        <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder=" Email">
        </div>

        <div class="form-group">
            <input class="form-control" type="text" name="username" placeholder=" Username">
        </div>

        <div class="form-group">
            <input class="form-control" type="text" name="full_name" placeholder=" Full name">
        </div>

        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder=" Password" required>
        </div>

        <div class="form-group">
            <input class="form-control" type="password" name="confirm_password" placeholder=" Confirm password" required>
        </div>

        <button type="submit">Create an account</button>
    </form>
    <p class="new-account">Do you already have an account? <a href="/index.php" class="bold">Please login!</a></p>
    </div>
</article>

<?php require __DIR__.'/views/footer.php'; ?>