<?php require __DIR__.'/views/header.php'; ?>
<?php require __DIR__.'/views/navigation-top.php'; ?>

<article class="all-posts">

<?php 

// Get people the user follows
$loggedInUser = $_SESSION['user']['user_id'];
$statement = $pdo->prepare("SELECT user_id_2 FROM follower WHERE user_id_1 = '$loggedInUser'");
$statement->execute();
$follows = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!$follows ) {
    echo "<br>You don't follow anyone yet";
}

foreach ($follows as $follow) :
    $usersfollow = $follow['user_id_2'];

    // Get all photo information from people the user follows   
    $statement = $pdo->prepare("SELECT * FROM photos where user_id = :follow_user_id ORDER BY  date_created DESC");
    $statement->bindParam(':follow_user_id', $usersfollow, PDO::PARAM_INT);
    $statement->execute();
    $photos = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Get user information from people the user follows   
    $statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $usersfollow, PDO::PARAM_INT);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($users as $user) {
        $userId = $user['user_id'];
        $username = $user['username'];
        $fullName = $user['full_name'];
        $biography = $user['biography'];
        $avatar = $user['avatar'];
    }

// Get all photos from people the user follows 
foreach ($photos as $photo) : 
    $photoId = $photo['photo_id'];

    // Get number of likes from each photos 
    $statement = $pdo->prepare('SELECT * FROM likes WHERE photo_id = :photo_id');
    $statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);
    $statement->execute();
    $likes = $statement->fetchAll(PDO::FETCH_ASSOC);

    $amoutOfLikes = count($likes);
    $amoutOfLikesWithoutUser = $amoutOfLikes - 1;

    if (!$likes) {
        $userIdLikes = 0;
    }

    foreach ($likes as $like) {
        $userIdLikes =  $like['user_id'];
    }

    ?>
    <div class="all-posts-container">
    <form action="/profile.php" method="GET">
    <button type="submit" name="user_id" value="<?php echo $user['user_id'] ?>">
    <ul>
        <li class="avatar-user">
            <?php if (!$user['avatar']): ?>
                <img class="avatar" src="/images/no-avatar.png" alt="">
                <?php else: ?>
                    <img class="avatar" src="/uploads/<?php echo $user['avatar'] ?>" alt="">
            <?php endif; ?>
            <p class="username"><?php echo $user['username'] ?></p></li>
    </ul>
        </button>
    </form>
    <div class="image-container">
    <img class="image" id="<?php echo $photoId?>" src="/uploads/images/<?php echo $photo['image']; ?>" alt="<?php echo $photoId?>" loading="lazy">
    </div>
    <form class="like-container" action="/app/posts/like.php" method="GET">
    <?php if ($userIdLikes != $loggedInUser): ?>
        <button id="heart" type="submit" name="photo_id" value="<?php echo $photo['photo_id']?>"><img class="heart" src="/icons/not-liked.png" alt=""></button>
        <?php if ($amoutOfLikes >= 1): ?>
            <p>Liked of <?php echo $amoutOfLikes?> people</p>
        <?php endif; ?>
        </form>
        <?php elseif ($userIdLikes === $loggedInUser) : ?>
                <button id="heart" type="submit" name="photo_id" value="<?php echo $photo['photo_id']?>"><img class="heart" src="/icons/liked.png" alt=""></button>
                <?php if ($amoutOfLikes > 1): ?>
                <p>Liked of you and <?php echo $amoutOfLikesWithoutUser ?> people</p>    
                <?php else : ?>
                <p>Liked of you</p>
                <?php endif; ?>    
            </form>
    <?php endif; ?>
    <p class="caption-container">
    <span><?php echo $user['username']?></span> 
    <?php echo $photo['caption'];?>
    </p>
    <p class="date"><?php echo $photo['date_created'];?></p>
</div>
</div>
<?php endforeach; ?>
<?php endforeach; ?>
</article>


        <?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>