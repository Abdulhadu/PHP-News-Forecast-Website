<?php include "config.php"; ?>
<?php 
$id = $_GET['post_id'];
 
    $sql = "DELETE FROM `post` WHERE post_id={$id};";
    
    if(mysqli_query($conn, $sql))
    {
        header("location: post.php");
    }


mysqli_close($conn);
?>