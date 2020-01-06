<?php require __DIR__.'/views/header.php'; ?>

<?php 

$loggedInUser = $_SESSION['user']['user_id'];
$userId = $_GET['user_id'];

$statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');

$statement->bindParam(':user_id', $userId, PDO::PARAM_INT);

$statement->execute();

$user = $statement->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    $errors[] = "Can't find this user!";
}

$username = $user['username'];
$fullName = $user['full_name'];
$biography = $user['biography'];
$avatar = $user['avatar'];


$statement = $pdo->prepare('SELECT * FROM photos WHERE user_id = :user_id ORDER BY  date_created DESC');

$statement->bindParam(':user_id', $userId, PDO::PARAM_STR);

$statement->execute();

$photos = $statement->fetchAll(PDO::FETCH_ASSOC);

$amountOfPosts = count($photos);

if (!$photos) {
    $errors[] = "No photos";
}

$statement = $pdo->prepare('SELECT * FROM follower WHERE user_id_1 = :user_id_1');

$statement->bindParam(':user_id_1', $userId, PDO::PARAM_INT);

$statement->execute();

$follows = $statement->fetchAll(PDO::FETCH_ASSOC);

$amountOfFollows = count($follows);


$statement = $pdo->prepare('SELECT * FROM follower WHERE user_id_2 = :user_id_2');

$statement->bindParam(':user_id_2', $userId, PDO::PARAM_INT);

$statement->execute();

$followers = $statement->fetchAll(PDO::FETCH_ASSOC);

$amountOfFollowers = count($followers);

if (isset($_GET['user_id'])){

    $theFollower = $_SESSION['user']['user_id'];
    $theFollows = $user['user_id'];

    $statement = $pdo->prepare('SELECT * FROM follower WHERE user_id_1 = :user_id_1 AND user_id_2 = :user_id_2');

    if (!$statement) {
    die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user_id_1', $theFollower, PDO::PARAM_INT);
    $statement->bindParam(':user_id_2', $theFollows, PDO::PARAM_INT);

    $statement->execute();

    $following = $statement->fetch(PDO::FETCH_ASSOC);

}

?>





<article class="my-posts">

<a href="/all-posts.php"><img src="/icons/back.png" alt="" class="back"></a>

    <ul class="profile-header">
        <li class="profile-user"><?php echo $username ?></li>
    </ul>

    <ul class="profile-information">
        <li><img class="avatar bigger" src="/uploads/<?php echo $avatar; ?>"alt=""></li>
        <li><p class="bold"><?php echo $amountOfPosts ?></p><span>Posts</span></li>
        <li><p class="bold"><?php echo $amountOfFollowers ?></p><span>Followers</span></li>
        <li><p class="bold"><?php echo $amountOfFollows ?></p><span>Follows</span></li>
    </ul>

    <ul class="profile-about">
        <li><p class="full-name"><?php echo $fullName ?></p></li>
        <li><p class="biography"><?php echo $biography ?></p></li>
    </ul>

    <?php if ($loggedInUser == $userId) : ?>
            <button class="edit-profil"><a href="/profile.php">Edit profil</a></button>
            <button class="edit-profil"><a href="/app/users/logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a></button>
    <?php elseif ($loggedInUser != $userId) : ?>
        <form action="/app/users/follow.php" method="GET">
        <?php if ($following): ?>
            <button class="edit-profil" type="submit" name="user_id" value="<?php echo $userId ?>">Unfollow</button></form>
            <?php elseif (!$following): ?>
                <button class="edit-profil" type="submit" name="user_id" value="<?php echo $userId ?>">Follow</button></form>
        <?php endif; ?>
    <?php endif; ?>

    <!-- <ul class="picture-view-nav">
        <li><button><a href=""><img class="icon" src="/grid.png" alt=""></a></button></li>
        <li><button><a href=""><img class="icon" src="/row.png" alt=""></a></button></li>
    </ul> -->

    <?php foreach ($errors as $error) : ?>
        <li><?php echo $error ?></li>
    <?php endforeach ?>

    <?php foreach ($successes as $success) : ?>
        <li><?php echo $success ?></li>
    <?php endforeach ?>
    
    <main>
    <div class="container">
<?php if (isset($_SESSION['user'])) :?>
<?php foreach ($photos as $photo) : ?>
    <form action="/post.php" method="GET">
    <button type="submit" name="photo_id" value="<?php echo $photo['photo_id'] ?>">
    <img class="small-image" src="/uploads/images/<?php echo $photo['image']; ?>" alt="">
    </button>
    </form>
    
    <?php endforeach ?>
    <?php endif; ?>
    </div>
    </main>
</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>