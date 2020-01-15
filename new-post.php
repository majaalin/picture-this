<?php require __DIR__.'/views/header.php'; 

// If user not logged in
if(!isset($_SESSION['user'])) {
    $errors[] = "You need to login";
    $_SESSION['errors'] = $errors;
    redirect("/");
    exit;
}
?>

<article>
    <img src="/icons/back.png" alt="back" class="back" onclick="goBack()">
    <h1>New post</h1>
    <form class="new-form" action="/app/posts/new-post.php" method="post" enctype="multipart/form-data">
    <img src="/images/no-picture.png" id="previewImage" class="image"/>
        <div class="new-post">
            <label class="make-a-image" for="image">Add a photo</label>
            <input class="html_btn" type="file" id="image" name="image" accept=".png, .jpg, .jpeg"  onchange="document.getElementById('previewImage').src = window.URL.createObjectURL(this.files[0])">
        </div>
        <div class="form-group">
            <textarea class="form-control" type="text" name="caption" rows="5" cols="50" placeholder="Add a caption"></textarea>
        </div>
        <button class="update-profile" type="submit" name="update">Post</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
