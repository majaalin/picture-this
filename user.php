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

$amountOfPosts = count($photos);

if (!$photos) {
    $errors[] = "You don't have any photos";
}

?>

<article>
<!-- <?php if (isset($_SESSION['user'])): ?>
                <a class="nav-link" href="/app/users/logout.php" onclick="return confirm('Are you sure you want to logout?')" >Logout</a>
            <?php else: ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Login</a>
            <?php endif; ?> -->

    <?php foreach ($errors as $error) : ?>
        <li><?php echo $error ?></li>
    <?php endforeach ?>

    <?php foreach ($successes as $success) : ?>
        <li><?php echo $success ?></li>
    <?php endforeach ?>


    <ul class="profile-header">
        <li class="profile-user"><?php echo $username ?></li>
        <li class="exit"><button><a href="/app/users/logout.php"><img class="icon" src="/exit.png" alt=""></a></button></li>
    </ul>

    <ul class="profile-information">
        <li><img class="avatar bigger" src="/uploads/<?php echo $avatar; ?>"alt=""></li>
        <li><p class="bold"><?php echo $amountOfPosts ?></p><span>Posts</span></li>
        <li><p class="bold">237</p><span>Followers</span></li>
        <li><p class="bold">500</p><span>Follows</span></li>
    </ul>

    <ul class="profile-about">
        <li><p class="full-name"><?php echo $fullName ?></p></li>
        <li><p class="biography"><?php echo $biography ?></p></li>
    </ul>

    <button class="edit-profil"><a href="/app/users/follow.php">Follow</a></button>


    <ul class="picture-view-nav">
        <li><button><a href=""><img class="icon" src="/grid.png" alt=""></a></button></li>
        <li><button><a href=""><img class="icon" src="/row.png" alt=""></a></button></li>
    </ul>

    <div class="container">
<?php if (isset($_SESSION['user'])) :?>
<?php foreach ($photos as $photo) : ?>
    <img class="small-image" src="/uploads/images/<?php echo $photo['image']; ?>" alt="">
    
    <?php endforeach ?>
    <?php endif; ?>
    </div>
</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>