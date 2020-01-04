<?php require __DIR__.'/views/header.php'; ?>
<?php require __DIR__.'/views/navigation-top.php'; ?>

<?php 

$loggedInUser = $_SESSION['user']['user_id'];

$statement = $pdo->prepare("SELECT user_id_2 FROM follower WHERE user_id_1 = '$loggedInUser'");

$statement->execute();

$follows = $statement->fetchAll(PDO::FETCH_ASSOC);


foreach ($follows as $follow) {
    $foll = $follow['user_id_2'];
    
$statement = $pdo->prepare("SELECT * FROM photos where user_id = :user_id");

$statement->bindParam(':user_id', $foll, PDO::PARAM_INT);

$statement->execute();

$photos = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');

$statement->bindParam(':user_id', $foll, PDO::PARAM_INT);

$statement->execute();

$users = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {


if (!$user) {
    $errors[] = "Can't find this user!";
}

$username = $user['username'];
$fullName = $user['full_name'];
$biography = $user['biography'];
$avatar = $user['avatar'];

}

$statement = $pdo->prepare('SELECT * FROM likes WHERE photo_id = :photo_id');

$statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);

$statement->execute();

$likes = $statement->fetchAll(PDO::FETCH_ASSOC);

$amoutOfLikes = count($likes);




?>
    <article>
<?php foreach ($photos as $photo): ?>
    <div>
    <form action="/my-posts.php" method="GET">
    <button type="submit" name="user_id" value="<?php echo $user['user_id'] ?>">
    <ul>
        <li class="avatar-user">
            <img class="avatar" src="/uploads/<?php echo $user['avatar'] ?>" alt="">
            <p class="username"><?php echo $user['username'] ?></p></li>
    </ul>
        </button>
    </form>
    <div class="image-container">
    <img class="image" src="/uploads/images/<?php echo $photo['image']; ?>" alt="">
    </div>
    <form action="/app/posts/like.php" method="GET">
    <?php $photoId = $photo['photo_id'];?>
    <button id="heart" type="submit" name="photo_id" value="<?php echo $photo['photo_id'] ?>"><img class="heart" onclick="lik"src="/icons/like.png" alt=""></button>
    </form>
    <p>Likes of <?php echo $amoutOfLikes?> people</p>
    <div class="caption-container">
    <span class="post-username"><?php echo $user['username']?></span> 
    <span class="post-caption"><?php echo $photo['caption'];?></span>
    </div>
    <p class="date"><?php echo $photo['date_created'];?></p>
</div>
<?php endforeach; ?>
</article>


<?php } require __DIR__.'/views/navigation-bottom.php'; ?>
<?php require __DIR__.'/views/footer.php'; ?>