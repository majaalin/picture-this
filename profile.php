<?php require __DIR__.'/views/header.php'; ?>

<?php 

$userId = $_SESSION['user']['user_id'];
$email = $_SESSION['user']['email'];
$username = $_SESSION['user']['username'];
$fullName = $_SESSION['user']['full_name'];
$avatar = $_SESSION['user']['avatar'];
$biography = $_SESSION['user']['biography'];

if (isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];
    $destination = __DIR__.'/uploads/'.date('ymd')."-".$_FILES['avatar']['name'];
    move_uploaded_file($avatar['tmp_name'], $destination); 
    
    $avatarPath = date('ymd')."-".$_FILES['avatar']['name'];

    $statement = $pdo->prepare("UPDATE users SET avatar = :avatar  WHERE user_id = :user_id");
    $statement->bindParam(":avatar", $avatarPath);
    $statement->bindParam(":user_id", $userId);
    $statement->execute();
};

if (isset($_POST['update'])) {
    $successes = [];
    if (isset($_POST['email'])) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
            $statement = $pdo->prepare('UPDATE users SET email = :email WHERE user_id = :user_id');
            
            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }
    
            $statement->execute([
                ':user_id' => $userId,
                ':email' => $email,
                ]);
                
                $successes[] = "Your email were successfully updated";
    }
        if (isset($_POST['username'])) {
                $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        
                $statement = $pdo->prepare('UPDATE users SET username = :username WHERE user_id = :user_id');
                
                if (!$statement) {
                    die(var_dump($pdo->errorInfo()));
                }
        
                $statement->execute([
                    ':user_id' => $userId,
                    ':username' => $username,
                    ]);
                    
                    $successes[] = "Your username were successfully updated";
 }

        if (isset($_POST['full_name'])) {
            $fullName = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
    
            $statement = $pdo->prepare('UPDATE users SET full_name = :full_name WHERE user_id = :user_id');
            
            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }
    
            $statement->execute([
                ':user_id' => $userId,
                ':full_name' => $fullName,
                ]);
                
                $successes[] = "Your full name were successfully updated";
    }

    if (isset($_POST['biography'])) {
        $biography = filter_var($_POST['biography'], FILTER_SANITIZE_STRING);

        $statement = $pdo->prepare('UPDATE users SET biography = :biography WHERE user_id = :user_id');
        
        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->execute([
            ':user_id' => $userId,
            ':biography' => $biography,
            ]);
            
            $successes[] = "Your biography were successfully updated";
}

    if (count($successes) > 0){
        $_SESSION['successes'] = $successes;
        redirect('/profile.php');
        exit;
    }


        }
?>

<article>
    <h1>Profile</h1>
    
    <ul>
    <?php foreach ($successes as $success) : ?>
        <li><?php echo $success ?></li>
    <?php endforeach ?>
    </ul>

<form action="/profile.php" method="post" enctype="multipart/form-data">
            <div>
                <?php if (!$avatar) : ?>
                <img src="/uploads/no-image.png" alt="">
                <label for="avatar">Add a profile picture</label>
                <?php else : ?>
                    <img src="/uploads/<?php echo $_SESSION['user']['avatar']; ?>" alt="">
                <label for="avatar">Change profile picture</label>
                <?php endif ?>
                <input type="file" name="avatar" id="avatar" accept=".png">
            </div>

            <button type="submit">Upload</button>

    <form action="app/users/register.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="name">Username</label>
            <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="name">Full name</label>
            <input class="form-control" type="text" name="full_name" value="<?php echo $fullName; ?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="name">Biography</label>
            <textarea class="form-control" type="text" name="biography" rows="5" cols="50"><?php echo $biography; ?></textarea>
        </div><!-- /form-group -->

        <button type="submit" name="update" class="btn btn-primary">Update profile</button>
    </form>
</article>

<a href="/password.php"><button class="btn btn-primary">Change password</button></a>

<form action="app/user/update.php"></form>

<?php require __DIR__.'/views/footer.php'; ?>