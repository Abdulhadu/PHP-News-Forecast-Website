<?php include "header.php"; ?>
<?php include "config.php"; ?>
<?php

session_start();
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
if (isset($_FILES['fileToUpload'])) {
    $errors = array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_ext = strtolower(end(explode('.', $file_name)));

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

    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $catgory = mysqli_real_escape_string($conn, $_POST['category']);
    $author = $_SESSION['user_id'];
    $date = date("D M, Y");

    $sql = "INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES (NULL, '$title', '$desc', '$catgory', '$date', '$author', '$file_name'); ";
    $sql .= "UPDATE category SET post = post + 1 WHERE category_id='$catgory'";

    if (mysqli_multi_query($conn, $sql)) {
        header("location: post.php");
    }
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select name="category" class="form-control">
                            <option disabled>Select Catagory</option>
                            <?php
                            $sql = "SELECT * FROM `category`";
                            $result = mysqli_query($conn, $sql);
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
                        <label for="exampleInputPassword1">Post image</label>
                        <input type="file" name="fileToUpload" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                </form>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>