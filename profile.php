<?php require __DIR__.'/views/header.php'; ?>

<?php 

$userId = $_SESSION['user']['user_id'];
$email = $_SESSION['user']['email'];
$username = $_SESSION['user']['username'];
$fullName = $_SESSION['user']['full_name'];
$avatar = $_SESSION['user']['avatar'];

if (isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];
    $destination = __DIR__.'/uploads/'.$userId;
    move_uploaded_file($avatar['tmp_name'], $destination); 

}

?>

<article>
    <h1>Profile</h1>

<form action="/profile.php" method="post" enctype="multipart/form-data">
            <div>
                <?php if (!$avatar) : ?>
                <img src="no-image.png" alt="">
                <label for="avatar">Add a profile picture</label>
                <?php else : ?>
                <img src="<?php echo $avatar ?>" alt="">
                <label for="avatar">Change profile picture</label>
                <?php endif ?>
                <input type="file" name="avatar" id="avatar" accept=".png" required>
            </div>

            <button type="submit">Upload</button>

    <form action="app/users/register.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="name">Username</label>
            <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="name">Full name</label>
            <input class="form-control" type="text" name="full_name" value="<?php echo $fullName; ?>">
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Update profile</button>
    </form>
</article>

<form action="app/user/update.php"></form>

<?php require __DIR__.'/views/footer.php'; ?>