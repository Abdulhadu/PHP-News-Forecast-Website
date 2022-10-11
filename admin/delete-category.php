<?php include "config.php"; ?>
<?php 
$catid = $_GET['cat_id'];
 
    $sql = "DELETE FROM `category` WHERE category_id ={$catid};";
    
    if(mysqli_query($conn, $sql))
    {
        header("location: category.php");
    }


mysqli_close($conn);
?>