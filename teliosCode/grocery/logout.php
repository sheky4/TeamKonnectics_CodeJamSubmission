<?php 

// http://stackoverflow.com/questions/6455965/how-to-unset-a-specific-php-session-on-logout

session_start();
unset($_SESSION['groceryID']);
header('Location: index.php');

?>

