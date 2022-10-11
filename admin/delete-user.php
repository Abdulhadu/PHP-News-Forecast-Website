<?php include "config.php"; ?>
<?php 
$id = $_GET['user_id'];
 
    $sql = "DELETE FROM `user` WHERE user_id={$id};";
    
    if(mysqli_query($conn, $sql))
    {
        header("location: users.php");
    }


mysqli_close($conn);
?>
