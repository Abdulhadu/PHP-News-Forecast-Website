<?php include "header.php"; ?>
<?php include "config.php"; ?>

<?php
$id = $_GET['user_id'];
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {

    $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "UPDATE user SET first_name = '$fname', last_name = '$lname', username = '$user', role = '$role' WHERE user_id='$id'";

    if (mysqli_query($conn, $sql) > 0) {
        header("location: users.php");
    }
}
?>



<?php
$id = $_GET['user_id'];
$sql = "SELECT * FROM `user` WHERE user_id = '$id';";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['user_id'];
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $user = $row['username'];
        $role = $row['role'];
?>
        <div id="admin-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="admin-heading">Modify User Details</h1>
                    </div>
                    <div class="col-md-offset-4 col-md-4">
                        <!-- Form Start -->
                        <form action="<?php $_SERVER['PHP_SELF']  ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $id; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo $fname; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control" value="<?php echo $lname; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $user; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role" value="<?php echo $user; ?>">
                                    <?php
                                    if ($role == 0) {
                                        echo '<option value="0" selected>normal User</option>
                            <option value="1">Admin</option>';
                                    } else {
                                        echo '<option value="0">normal User</option>
                            <option value="1" selected>Admin</option>';
                                    }
                                    ?>"
                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                    <?php } ?>
                <?php } ?>
                <!-- /Form -->
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.php"; ?>