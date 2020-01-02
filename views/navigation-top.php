<?php

$userId = $_SESSION['user']['user_id'];

?>

<nav>
<ul class="navbar-nav" id="navbar-nav">
        <li>
            <button><a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/posts.php"><img src="camera.png" alt="camera" id="camera" class="icon" onmouseover="hoverCamera();" onmouseout="unhoverCamera()";></a></button>
        </li>
        <li>
        <button><a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/index.php"><img src="logo.png" alt="logo" class="logo"></a></button>
        </li>
        <li>
        <button> <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/my-posts.php <?php"><img src="user.png" alt="user" class="icon" id="user" onmouseover="hoverUser();" onmouseout="unhoverUser()";></a></button>
        </li>
    </ul>
</nav>
            
                
            
       