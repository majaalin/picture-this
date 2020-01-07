<?php require __DIR__.'/views/header.php'; ?>
<?php require __DIR__.'/views/navigation-top.php'; ?>

<?php 

$loggedInUser = $_SESSION['user']['user_id'];

$statement = $pdo->prepare("SELECT user_id_2 FROM follower WHERE user_id_1 = '$loggedInUser'");

$statement->execute();

$follows = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($follows as $follow) :
    $foll = $follow['user_id_2'];
    
$statement = $pdo->prepare("SELECT * FROM photos where user_id = :user_id ORDER BY  date_created DESC");

$statement->bindParam(':user_id', $foll, PDO::PARAM_INT);

$statement->execute();

$photos = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');

$statement->bindParam(':user_id', $foll, PDO::PARAM_INT);

$statement->execute();

$users = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {

$userId = $user['user_id'];
$username = $user['username'];
$fullName = $user['full_name'];
$biography = $user['biography'];
$avatar = $user['avatar'];
}

?>
    <article class="all-posts">

<?php foreach ($photos as $photo): 
    
    $photoId = $photo['photo_id'];

    $statement = $pdo->prepare('SELECT * FROM likes WHERE photo_id = :photo_id');
    
    $statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);
    
    $statement->execute();
    
    $likes = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!$likes) {
        $userIdLikes = 0;
    }
    
    $amoutOfLikes = count($likes);

    $amoutOfLikesWithoutUser = $amoutOfLikes - 1;

    foreach ($likes as $like) {
        $userIdLikes =  $like['user_id'];
    }

    ?>
    <div class="all-posts-container">
    <form action="/profile.php" method="GET">
    <button type="submit" name="user_id" value="<?php echo $user['user_id'] ?>">
    <ul>
        <li class="avatar-user">
            <img class="avatar" src="/uploads/<?php echo $user['avatar'] ?>" alt="">
            <p class="username"><?php echo $user['username'] ?></p></li>
    </ul>
        </button>
    </form>
    <div class="image-container">
    <img class="image" src="/uploads/images/<?php echo $photo['image']; ?>" alt="" loading="lazy">
    </div>
    <form class="like-container" action="/app/posts/like.php" method="GET">
    <?php $photoId = $photo['photo_id'];?>
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
    <div class="caption-container">
    <span class="post-username"><?php echo $user['username']?></span> 
    <span class="post-caption"><?php echo $photo['caption'];?></span>
    </div>
    <p class="date"><?php echo $photo['date_created'];?></p>
</div>
</div>
<?php endforeach; ?>
<?php endforeach; ?>
</article>


        <?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>