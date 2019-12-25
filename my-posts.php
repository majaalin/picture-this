<?php require __DIR__.'/views/header.php'; ?>

<?php 

$userId = $_SESSION['user']['user_id'];
$username = $_SESSION['user']['username'];
$fullName = $_SESSION['user']['full_name'];
$biography = $_SESSION['user']['biography'];
$avatar = $_SESSION['user']['avatar'];

$statement = $pdo->prepare('SELECT * FROM photos WHERE user_id = :user_id ORDER BY  date_created DESC');

$statement->bindParam(':user_id', $userId, PDO::PARAM_STR);

$statement->execute();

$photos = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!$photos) {
    $errors[] = "You don't have any photos";
}

?>

<article>

<a href="/..">Back</a>

<?php foreach ($errors as $error) : ?>
        <li><?php echo $error ?></li>
    <?php endforeach ?>

    <ul>
    <?php foreach ($successes as $success) : ?>
        <li><?php echo $success ?></li>
    <?php endforeach ?>
    </ul>
    <div class="user">
    <div class="user-header">
    <img class="avatar" src="/uploads/<?php echo $avatar; ?>"alt="">
    <h1 class="username"><?php echo $username ?></h1>
    <button type="submit" name="photo_id" value="<?php echo $photoId ?>"><a href="/profile.php"><img class="settings" src="settings.png" alt=""></a></button>
    </div>
    <p class="full-name"><?php echo $fullName ?></p>
    <p class="biography"><?php echo $biography  ?></p>
    <button><a href="/profile.php">Edit profil</a></button>
    </div>


    <li class="nav-item">
            <?php if (isset($_SESSION['user'])): ?>
                <a class="nav-link" href="/app/users/logout.php" onclick="return confirm('Are you sure you want to logout?')" >Logout</a>
            <?php else: ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
            <?php endif; ?>

    <?php foreach ($photos as $photo) : ?>
        <div class="post">
        <div class="post-header">
    <img class="avatar" src="/uploads/<?php echo $avatar; ?>" alt="">
    <p class="username"><?php echo $username ?></p>
        </div>
    <div class="image-container">
    <img class="image" src="/uploads/images/<?php echo $photo['image']; ?>" alt="">
    <form action="/edit-post.php" method="GET">
    <?php $photoId = $photo['photo_id'];?>
    <button type="submit" name="photo_id" value="<?php echo $photoId ?>"><img class="edit" src="/edit.png" alt=""></button>
    </form>
    </div>
    <p>x likes</p>
    <div class="caption-container">
    <span class="username"><?php echo $username ?></span> 
    <span class="caption"><?php echo $photo['caption'];?></span>
    </div>
    <p class="date"><?php echo $photo['date_created'];?></p>
    </div>
    <?php endforeach ?>
</article>

<?php require __DIR__.'/views/footer.php'; ?>