<?php require __DIR__.'/views/header.php'; ?>

<?php 
$loggedInUser = $_SESSION['user']['user_id'];
$userId = $_GET['user_id'];

// If user not logged in
if(!isset($_SESSION['user'])) {
    $errors[] = "You need to login";
    $_SESSION['errors'] = $errors;
    redirect("/");
    exit;
}

// Get user information from profile owner
$statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
$statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

// If user do not exist
if (!$user) {
            $errors[] = "Can't find user";
            $_SESSION['errors'] = $errors;
            redirect("/posts.php");
            exit;
}

// User information
$username = $user['username'];
$fullName = $user['full_name'];
$biography = $user['biography'];
$avatar = $user['avatar'];

// Get photos from profile owner
$statement = $pdo->prepare('SELECT * FROM photos WHERE user_id = :user_id ORDER BY  date_created DESC');
$statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
$statement->execute();
$photos = $statement->fetchAll(PDO::FETCH_ASSOC);

// Get number of photos
$amountOfPosts = count($photos);

if (!$photos) {
    $errors[] = "No photos";
}

// Get number of follows
$statement = $pdo->prepare('SELECT * FROM follower WHERE user_id_1 = :user_id_1');
$statement->bindParam(':user_id_1', $userId, PDO::PARAM_INT);
$statement->execute();
$follows = $statement->fetchAll(PDO::FETCH_ASSOC);
$amountOfFollows = count($follows);

// Get number of followers
$statement = $pdo->prepare('SELECT * FROM follower WHERE user_id_2 = :user_id_2');
$statement->bindParam(':user_id_2', $userId, PDO::PARAM_INT);
$statement->execute();
$followers = $statement->fetchAll(PDO::FETCH_ASSOC);
$amountOfFollowers = count($followers);

// Check if the logged in user is following the profile owner
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

<a href="/posts.php"><img src="/icons/back.png" alt="back" class="back"></a>

        <h1><?php echo $username ?></h1>

    <ul class="profile-information">
        <?php if (!$avatar): ?>
            <li><img class="avatar bigger" src="/images/no-avatar.png" alt="avatar"></li>
            <?php else: ?>
                <li><img class="avatar bigger" src="/uploads/<?php echo $avatar; ?>"alt="avatar"></li>
        <?php endif; ?>
        <li><p class="bold"><?php echo $amountOfPosts ?></p><span>Posts</span></li>
        <li><p class="bold"><?php echo $amountOfFollowers ?></p><span>Followers</span></li>
        <li><p class="bold"><?php echo $amountOfFollows ?></p><span>Following</span></li>
    </ul>

    <ul class="profile-about">
        <li><p class="full-name"><?php echo $fullName ?></p></li>
        <li><p class="biography"><?php echo $biography ?></p></li>
    </ul>

    <!-- If logged in user is the profile owner   -->
    <?php if ($loggedInUser == $userId) : ?>
            <button class="edit-profil"><a href="/edit-profile.php">Edit profile</a></button>
            <button class="logout"><a href="/app/users/logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a></button>
    <!-- If logged in user is a visitor  -->
        <?php elseif ($loggedInUser != $userId) : ?>
        <form action="/app/users/follow.php" method="GET">
         <!-- If logged in user follows the profile owner -->
        <?php if ($following): ?>
            <button class="edit-profil" type="submit" name="user_id" value="<?php echo $userId ?>">Unfollow</button></form>
            <!-- If logged in user does not follows the profile owner -->
            <?php elseif (!$following): ?>
                <button class="edit-profil" type="submit" name="user_id" value="<?php echo $userId ?>">Follow</button></form>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Show all photos from profile owner   -->
    <main>
    <div class="container">
<?php if (isset($_SESSION['user'])) :?>
<?php foreach ($photos as $photo) : ?>
    <form action="/post.php" method="GET">
    <button type="submit" name="photo_id" value="<?php echo $photo['photo_id'] ?>">
    <img class="small-image" src="/uploads/<?php echo $photo['image']; ?>" alt="small-image">
    </button>
    </form>
    
    <?php endforeach ?>
    <?php endif; ?>
    </div>
    </main>
</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>