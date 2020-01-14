<?php require __DIR__.'/views/header.php'; 

if(isset($_GET['photo_id'])){
    $photoId = $_GET['photo_id'];

    // Get photo from photo id
    $statement = $pdo->prepare('SELECT * FROM photos WHERE photo_id = :photo_id');
    $statement->bindParam(':photo_id', $photoId, PDO::PARAM_INT);
    $statement->execute();
    $photo = $statement->fetch(PDO::FETCH_ASSOC);

        // Photo information
        $image = $photo['image'];
        $caption = $photo['caption'];
        $userId = $photo['user_id'];
}

// If photo id does not exist
if ($_SESSION['user']['user_id'] != $userId) {
    $errors[] = "You can't edit that picture";
    $_SESSION['errors'] = $errors;
    redirect('/profile.php');
    exit;
}

?>


<article class="edit-post">

<img src="/icons/back.png" alt="back" class="back" onclick="goBack()">
    <h1>Edit posts</h1>

    <form class="edit-profil-input" action="/app/posts/edit-post.php?photo_id=<?php echo $photoId ?>" method="post" enctype="multipart/form-data">

    <img id="previewPost" class="image" src="/uploads/<?php echo $image ?>" alt="preview">
    <div class="avatar">
            <label for="image">Select an image</label></div>
            <input type="file" id="image" name="image" accept=".png, .jpg, .jpeg" onchange="document.getElementById('previewPost').src = window.URL.createObjectURL(this.files[0])">
    <button class="edit-profil" type="submit">Update photo</button>

    </form>
    
    <form class="edit-profil-input" action="/app/posts/edit-post.php?photo_id=<?php echo $photoId ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
            <label for="name">Caption</label>
            <textarea class="form-control" type="text" name="caption" rows="5" cols="50"><?php echo $caption ?></textarea>
        </div>

        <button class="edit-profil" type="submit">Edit caption</button>
    </form>
    <form action="/app/posts/delete.php?photo_id=<?php echo $photoId ?>" method="post">
    <button class="edit-profil" type="submit" class="" onclick="return confirm('Are you sure you want to delete this post?')">Delete posts</button>
    </form>

</article>

<?php require __DIR__.'/views/footer.php'; ?>