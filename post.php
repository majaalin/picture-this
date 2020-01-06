<?php require __DIR__.'/views/header.php'; ?>

<?php 
$loggedInUser = $_SESSION['user']['user_id'];
$photoId = $_GET['photo_id'];

$statement = $pdo->prepare('SELECT * FROM photos WHERE photo_id = :photo_id');

$statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);

$statement->execute();

$photo = $statement->fetch(PDO::FETCH_ASSOC);

if (!$photo) {
    $errors[] = "Can't find this photo!";
}

$userId = $photo['user_id'];
$caption = $photo['caption'];
$image = $photo['image'];
$date = $photo['date_created'];


$statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');

$statement->bindParam(':user_id', $userId, PDO::PARAM_INT);

$statement->execute();

$user = $statement->fetch(PDO::FETCH_ASSOC);


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
    <ul class="posts-header">
        <li><img src="/icons/back.png" alt="" class="back" onclick="goBack()"></li>
        <li><p class="username"><?php echo $user['username']?></p></li>
        <li><p>Posts</p></li>
    </ul>
<article>
<div class="post">
    <form action="/my-posts.php" method="GET">
    <button type="submit" name="user_id" value="<?php echo $user['user_id'] ?>">
    <ul>
        <li class="avatar-user">
            <img class="avatar" src="/uploads/<?php echo $user['avatar'] ?>" alt="">
            <p class="username"><?php echo $user['username'] ?></p></li>
    </ul>
        </button>
    </form>
        <?php if ($loggedInUser === $user['user_id']): ?>
        <form action="/edit-post.php" method="GET">
        <button class="edit" type="submit" name="photo_id" value="<?php echo $photoId ?>"><img class="icon" src="/icons/more.png" alt="">
        </button>
        </form>
    <?php endif; ?>
    <div class="image-container">
    <img class="image" src="/uploads/images/<?php echo $image; ?>" alt="">
    </div>
    <form action="/app/posts/like.php" method="GET">
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
    <span class="post-caption"><?php echo $caption;?></span>
    </div>
    <p class="date"><?php echo $date;?></p>
</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>