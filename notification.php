<div class="notification">
    <ul>
    <?php foreach ($errors as $error): ?>
        <li><p><?php echo $error ?></p></li>
    <?php endforeach; ?>
    
    <?php foreach ($successes as $success): ?>
        <li><p><?php echo $success ?></p></li>
    <?php endforeach; ?>
    </ul>
</div>