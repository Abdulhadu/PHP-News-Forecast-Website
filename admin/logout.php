
<?php
session_start();
echo 'we are Logging Out Please wait......';
session_destroy();
header("location: index.php");


?>