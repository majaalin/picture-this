<?php require __DIR__.'/views/header.php'; 

$userId = $_SESSION['user']['user_id'];

// Get informatiom from user
$statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
$statement->bindParam(':user_id', $userId, PDO::PARAM_STR);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

// User information
$avatar = $user['avatar'];
$email = $user['email'];
$username = $user['username'];
$fullName = $user['full_name'];
$biography = $user['biography'];

?>

<article>

<img src="/icons/back.png" alt="back" class="back" onclick="goBack()">

    <h1>Edit profile</h1>

        <form class="edit-profil-container" action="/app/users/edit-profile.php" method="post" enctype="multipart/form-data">
            <div class="avatar">
                <?php if (!$avatar) : ?>
                <img id="previewAvatar" src="/images/no-avatar.png" alt="avatar">
                <label for="avatar">Add a profile picture</label>
                <?php else : ?>
                    <img id="previewAvatar" src="/uploads/<?php echo $avatar; ?>" alt="avatar">
                <label for="avatar">Change profile picture</label>
                <?php endif ?>
                <input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg" onchange="document.getElementById('previewAvatar').src = window.URL.createObjectURL(this.files[0])">
            </div>

            <div class="edit-profil-input">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="edit-profil-input">
            <label for="name">Username</label>
            <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
                </div>
                <div class="edit-profil-input">
            <label for="name">Full name</label>
            <input class="form-control" type="text" name="full_name" value="<?php echo $fullName; ?>">
                </div>
                <div class="edit-profil-input">
            <label for="name">Biography</label>
            <textarea class="form-control" type="text" name="biography" rows="5" cols="50"><?php echo $biography; ?></textarea>
                </div>
        <button class="update-profile" type="submit" name="update">Update profile</button>
        <button class="change-password"><a href="/change-password.php">Change password</a></button>

    </form>
</article>
<form action="app/users/delete.php" method="post">
<button type="submit" name="delete" class="btn btn-danger"  onclick="return confirm('Are you really sure you want to delete your profile?'), confirm('Are you really sure?')" >Delete profile</button>
</form>

<form action="app/user/update.php"></form>

<?php require __DIR__.'/views/footer.php'; ?>