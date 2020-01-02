<?php require __DIR__.'/views/header.php'; ?>

<?php 

$userId = $_SESSION['user']['user_id'];

$statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');

$statement->bindParam(':user_id', $userId, PDO::PARAM_STR);

$statement->execute();

$user = $statement->fetch(PDO::FETCH_ASSOC);

$avatar = $user['avatar'];
$email = $user['email'];
$username = $user['username'];
$fullName = $user['full_name'];
$biography = $user['biography'];

?>

<article>
    <a href="/..">Back</a>
    <h1>Profile</h1>
    
    <?php foreach ($errors as $error) : ?>
        <li><?php echo $error ?></li>
    <?php endforeach ?>

    <ul>
    <?php foreach ($successes as $success) : ?>
        <li><?php echo $success ?></li>
    <?php endforeach ?>
    </ul>

<form action="/app/users/profile.php" method="post" enctype="multipart/form-data">
            <div class="avatar">
                <?php if (!$avatar) : ?>
                <img src="/uploads/no-image.png" alt="">
                <label for="avatar">Add a profile picture</label>
                <?php else : ?>
                    <img src="/uploads/<?php echo $avatar; ?>" alt="">
                <label for="avatar">Change profile picture</label>
                <?php endif ?>
                <input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg">
            </div>

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

        <div class="form-group">
            <label for="name">Biography</label>
            <textarea class="form-control" type="text" name="biography" rows="5" cols="50"><?php echo $biography; ?></textarea>
        </div><!-- /form-group -->

        <button type="submit" name="update" class="btn btn-primary">Update profile</button>
    </form>
</article>

<a href="/password.php"><button class="btn btn-primary">Change password</button></a>

<form action="app/users/delete.php" method="post">
<button type="submit" name="delete" class="btn btn-danger"  onclick="return confirm('Are you really sure you want to delete your profile?'), confirm('Are you really sure?')" >Delete profile</button>
</form>

<form action="app/user/update.php"></form>

<?php require __DIR__.'/views/footer.php'; ?>