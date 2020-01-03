<?php 

$userId = $_SESSION['user']['user_id'];

?>

<nav>
<ul class="navbar-nav" id="navbar-nav">
        <li>
            <button><a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/posts.php"><img src="/icons/camera.png" alt="camera" id="camera" class="icon" onmouseover="hoverCamera();" onmouseout="unhoverCamera()";></a></button>
        </li>
        <li>
        <button><a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/index.php"><img src="/logo.png" alt="logo" class="logo"></a></button>
        </li>
        <li>
        <form action="/../my-posts.php" method="GET">
    <button type="submit" name="user_id" value="<?php echo $userId?>">
    <img src="/icons/user.png" alt="user" class="icon" id="user" onmouseover="hoverUser();" onmouseout="unhoverUser()";>
    </button>
    </form>
        </li>
    </ul>
</nav>

       