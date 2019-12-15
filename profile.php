<?php 

if(!isset($_SESSION['user'])) {
    redirect('/');
}

?>

<form action="app/user/update.php"></form>