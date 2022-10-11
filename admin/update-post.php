<?php include "header.php"; ?>
<?php include "config.php"; ?>

<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    if(empty($_FILES['new-image']['name']))
    {
        $file_name = $_POST['old-image'];
    }
    else{
        $errors = array();
        $file_name = $_FILES['new-image']['name'];
        $file_tmp = $_FILES['new-image']['tmp_name'];
        $file_size = $_FILES['new-image']['size'];
        $exploded = explode('.', $file_name);
        $last_element = end($exploded);
        $file_ext = strtolower($last_element);

        $extension = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extension) === false) {
            $errors[] = "This File type is not allowed. Please select jpg, png file";
        }
        if ($file_size > 2097152) {
            $errors[] = "File size must be in between 2MB";
        }
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "upload/" . $file_name);
        } else {
            print_r($errors);
            die();
        }
    }
    
    $id = $_GET['post_id'];
    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $catgory = mysqli_real_escape_string($conn, $_POST['category']);
    $date = date("D M, Y");

    $sql = "UPDATE `post` SET `post_id`='$id',`title`='$title',`description`='$desc',`category`='$catgory',`post_date`='$date',`post_img`='$file_name'  WHERE post_id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("location: post.php");
    }
}
?>

<?php
$id = $_GET['post_id'];
$sql = "SELECT * FROM `post` WHERE post_id = '$id';";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['post_id'];
        $title = $row['title'];
        $desc = $row['description'];
        $cat = $row['category'];
        $img = $row['post_img'];

?>
        <div id="admin-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="admin-heading">Update Post</h1>
                    </div>
                    <div class="col-md-offset-3 col-md-6">
                        <!-- Form for show edit-->
                        <form action="<?php $_SERVER['PHP_SELF']  ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <input type="hidden" name="post_id" class="form-control" value="<?php echo $id; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputTile">Tittle</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername" value="<?php echo $title; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Description</label>
                                <textarea name="postdesc" class="form-control" required rows="5"> <?php echo $desc; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCategory">Category</label>
                                <select class="form-control" name="category">
                                    <option value="" disabled>Choose Category</option>
                                    <?php
                                    $sql1 = "SELECT * FROM `category`";
                                    $result = mysqli_query($conn, $sql1);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['category_id'];
                                            $name = $row['category_name'];
                                    ?>
                                            <option value="<?php echo $id ?>" selected><?php echo $name ?></option>
                                        <?php } ?>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Post image</label>
                                <input type="file" name="new-image">
                                <img src="upload/<?php echo $img ?>" height="150px">
                                <input type="hidden" name="old-image" value="<?php echo $img; ?>">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                        </form>
                    <?php } ?>
                <?php } ?>
                <!-- Form End -->
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.php"; ?>