<?php 

require __DIR__.'/views/header.php'; ?>

<article>
    <a href="/..">Back</a>
    <h1>New posts</h1>

    <?php foreach ($errors as $error) : ?>
        <p><?php echo $error ?></p>
    <?php endforeach ?>

    <ul>
    <?php foreach ($successes as $success) : ?>
        <li><?php echo $success ?></li>
    <?php endforeach ?>
    </ul>

    <form action="/app/users/posts.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="image">Add a image</label>
            <input type="file" id="image" name="image" accept=".png, .jpg, .jpeg">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="caption">Add a caption</label>
            <textarea class="form-control" type="text" name="caption" rows="5" cols="50"></textarea>
        </div><!-- /form-group -->

        <button type="submit" name="update" class="btn btn-primary">Make a post</button>
    </form>
</article>
