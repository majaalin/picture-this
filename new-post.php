<?php 

require __DIR__.'/views/header.php'; ?>

<article>
<img src="/icons/back.png" alt="" class="back" onclick="goBack()">
    <h1>New posts</h1>

    <form class="new-form" action="/app/posts/new-post.php" method="post" enctype="multipart/form-data">

    <img src="/images/no-picture.jpg" id="previewImage" class="previewImage"/>

        <div class="form-group">
            <label class="make-a-image" for="image">Add a image</label>
            <input class="html_btn" type="file" id="image" name="image" accept=".png, .jpg, .jpeg"  onchange="document.getElementById('previewImage').src = window.URL.createObjectURL(this.files[0])">
        </div><!-- /form-group -->

        <div class="form-group">
            <textarea class="form-control" type="text" name="caption" rows="5" cols="50" placeholder="Add a caption"></textarea>
        </div><!-- /form-group -->

        <button class="make-a-post" type="submit" name="update">Make a post</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>