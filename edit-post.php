<?php require __DIR__.'/views/header.php'; ?>

<?php 

?>


    <?php  

    if(isset($_GET['photo_id'])){
        $photoId = $_GET['photo_id'];

        $statement = $pdo->prepare('SELECT * FROM photos WHERE photo_id = :photo_id');

        $statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);

        $statement->execute();

        $photo = $statement->fetch(PDO::FETCH_ASSOC);

        $image = $photo['image'];
        $caption = $photo['caption'];
        $userId = $photo['user_id'];
    }


    if ($_SESSION['user']['user_id'] != $userId) {
        $errors[] = "You can't edit that picture";

        if (count($errors) > 0){
            $_SESSION['errors'] = $errors;
            redirect('/my-posts.php');
            exit;
    }

}

?>


<article>

<img src="/icons/back.png" alt="" class="back" onclick="goBack()">
    <h1>Edit posts</h1>


<?php foreach ($errors as $error) : ?>
        <li><?php echo $error ?></li>
    <?php endforeach ?>

    <ul>
    <?php foreach ($successes as $success) : ?>
        <li><?php echo $success ?></li>
    <?php endforeach ?>
    </ul>

<div class="form-group">

    <form action="/app/users/edit-post.php?photo_id=<?php echo $photoId ?>" method="post" enctype="multipart/form-data">

    <img src="/uploads/images/<?php echo $image ?>" alt="">
    <div class="form-group">
            <label for="image">Change picture</label>
            <input type="file" id="image" name="image" accept=".png, .jpg, .jpeg">
    </div>
    <button class="edit-profil" type="submit">Update photo</button>
    </form>
    
    <form class="edit-post" action="/app/users/edit-post.php?photo_id=<?php echo $photoId ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
            <label for="name">Caption</label>
            <textarea class="form-control" type="text" name="caption" rows="5" cols="50"><?php echo $caption ?></textarea>
        </div><!-- /form-group -->

        <button class="edit-profil" type="submit">Edit caption</button>
    </form>
    <form action="/app/posts/delete.php?photo_id=<?php echo $photoId ?>" method="post">
    <button class="edit-profil" type="submit" class="" onclick="return confirm('Are you sure you want to delete this post?')">Delete posts</button>
    </form>

</article>

<?php require __DIR__.'/views/footer.php'; ?>