<nav>

  <ul class="navbar-nav" id="navbar-nav">

  <div class="logo-container">

    <li class="nav-item">
          <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/index.php"><img src="logo.png" alt="logo" class="logo"></a>
      </li><!-- /nav-item -->

    </div>

    <div class="nav-container">

  <li class="nav-item">
          <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/posts.php"><img src="camera.png" alt="camera" id="camera" class="nav-icon camera" onmouseover="hoverCamera();" onmouseout="unhoverCamera()";></a>
      </li><!-- /nav-item -->
      <li class="nav-item">
          <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/my-posts.php"><img src="user.png" alt="user" class="nav-icon user" id="user" onmouseover="hoverUser();" onmouseout="unhoverUser()";></a>
      </li><!-- /nav-item -->
      <!-- /nav-item -->
      </div>
  </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->
            
                
            
       