<!-- Shows if user get an error -->
<ul class="error-container">
<?php foreach ($errors as $error) { ?>
    <li class="messages error">&#9747; <?php echo $error ?></li>
<?php } ?>
</ul>

<!-- Shows if user success -->
<ul>
<?php foreach ($successes as $success) { ?>
    <li class="messages">&#10003; <?php echo $success ?></li>
<?php } ?>
</ul>
