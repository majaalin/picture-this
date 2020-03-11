<?php require __DIR__.'/views/header.php'; ?>

<?php
$loggedInUser = $_SESSION['user']['user_id'];
$photoId = $_GET['photo_id'];

// If user not logged in
if (!isset($_SESSION['user'])) {
    $errors[] = 'You need to login';
    $_SESSION['errors'] = $errors;
    redirect('/');
    exit;
}

// Get photo from photo id
$statement = $pdo->prepare('SELECT * FROM photos WHERE photo_id = :photo_id');
$statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);
$statement->execute();
$photo = $statement->fetch(PDO::FETCH_ASSOC);

if (!$photo) {
    $errors[] = "Can't find this photo!";
}

// Photo information
$userId = $photo['user_id'];
$caption = $photo['caption'];
$image = $photo['image'];
$date = $photo['date_created'];

// Get user information from owner of photo
$statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
$statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

// Get likes number of likes
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
    $userIdLikes = $like['user_id'];
}

?>
<article class="profile-posts">
<img src="/icons/back.png" alt="back" class="back" onclick="goBack()">
    <h1><?php echo $user['username'] ?></h1>
<div class="all-posts-container">
    <div class="avatar-user-container">
    <form action="/profile.php" method="GET">
    <button type="submit" name="user_id" value="<?php echo $user['user_id'] ?>">
    <ul>
        <li class="avatar-user">
            <?php if (!$user['avatar']) { ?>
                <img class="avatar" src="/images/no-avatar.png" alt="avatar">
                <?php } else { ?>
                    <img class="avatar" src="/uploads/<?php echo $user['avatar'] ?>" alt="avatar">
            <?php } ?>
            <p class="username"><?php echo $user['username'] ?></p></li>
        </button>
    </form>
        <?php if ($loggedInUser === $user['user_id']) { ?>
        <form action="/edit-post.php" method="GET">
        <li class="more">
        <button type="submit" name="photo_id" value="<?php echo $photoId ?>"><img class="icon" src="/icons/more.png" alt="more">
        </button>
        </li>
        </form>
        </ul>
    <?php } ?>
    </div>
    <div class="image-container">
    <img class="image" id="<?php echo $photoId?>" src="/uploads/<?php echo $photo['image']; ?>" alt="<?php echo $photoId?>" loading="lazy">
    </div>
    <form class="like-container" action="/app/posts/like.php" method="GET">
    <?php if ($userIdLikes != $loggedInUser) { ?>
        <button id="heart" type="submit" name="photo_id" value="<?php echo $photo['photo_id']?>"><img class="heart" src="/icons/not-liked.png" alt="heart"></button>
        <?php if ($amoutOfLikes >= 1) { ?>
            <p>Liked by <?php echo $amoutOfLikes?></p>
        <?php } ?>
        </form>
        <?php } elseif ($userIdLikes === $loggedInUser) { ?>
                <button id="heart" type="submit" name="photo_id" value="<?php echo $photo['photo_id']?>"><img class="heart" src="/icons/liked.png" alt="heart"></button>
                <?php if ($amoutOfLikes > 1) { ?>
                <p>Liked by you and <?php echo $amoutOfLikesWithoutUser ?> more</p>    
                <?php } else { ?>
                <p>Liked by you</p>
                <?php } ?>    
            </form>
    <?php } ?>
    <p class="caption-container">
    <span><?php echo $user['username']?></span> 
    <?php echo $photo['caption']; ?>
    </p>
    <p class="date"><?php echo $photo['date_created']; ?></p>

<!-- Comment section -->
    <div class="comment-wrapper">
        <?php $comments = getComments($photo['photo_id'], $pdo) ?>
        <ul class="comment-list">
            <?php foreach ($comments as $comment) { ?>
                <li class="comment">
                    <p class="comment-text">
                        <span><?php echo $comment['username']; ?></span> 
                        <?php echo $comment['comment']; ?>
                    </p>
                    <?php if ($comment['author_id'] === $loggedInUser) { ?>
                    <button class="edit-btn">Edit</button>
                    <div class="hidden">
                        <form class="edit-form" action="/app/posts/edit-comment.php" method="post">
                            <input class="comment-input" type="text" name="edit-comment" id="edit-comment" value="<?= $comment['comment']?>">
                            <input type="hidden" name="comment-id" id="comment-id" value="<?= $comment['id']?>">
                            <input type="hidden" name="username" id="username" value="<?= $comment['username']?>">
                            <button class="edit-comment" type="submit">Save</button>
                        </form>
                        <form class="delete-form" action="/app/posts/delete-comment.php" method="post">
                            <input type="hidden" name="comment-id" id="comment-id" value="<?= $comment['id']?>">
                            <input type="hidden" name="author-id" id="author-id" value="<?= $comment['author_id']?>">
                            <button class="delete-comment" type="submit">Delete</button>
                        </form>
                    </div>
                    <?php } ?>
                </li>
            <?php } ?>
        </ul>

        <form class="comment-form" action="/app/posts/comments.php" method="post">
            <div class="comment-container">
                <input class="comment-input" type="text" name="comment" id="comment" value="" placeholder="Comment this post...">
                <input type="hidden" name="post-id" id="post-id" value=" <?= $photoId ?>">
                <input type="hidden" name="logged-in-user" id="logged-in-user" value="<?= $_SESSION['user']['username'] ?>">
                <button class="send" type="submit">Send</button>
            </div>
        </form>
    </div>
<!-- Comment section -->

</article>

<?php require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>