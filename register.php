<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Register</h1>

    <form action="app/users/login.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" required>
            <small class="form-text text-muted">Please provide the your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="name" name="name" required>
            <small class="form-text text-muted">Please provide the your name.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide the your password.</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Create a user</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>