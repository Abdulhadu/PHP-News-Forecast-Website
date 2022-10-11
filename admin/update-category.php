<?php include "header.php"; ?>
<?php include "config.php"; ?>

<?php
$id = $_GET['cat_id'];
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {

    $name = mysqli_real_escape_string($conn, $_POST['cat_name']);

    $sql = "UPDATE `category` SET `category_name`='$name' WHERE category_id='$id'";

    if (mysqli_query($conn, $sql) > 0) {
        header("location: category.php");
    }
}
?>

<?php
$id = $_GET['cat_id'];
$sql = "SELECT * FROM `category` WHERE category_id = '$id';";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['category_id'];
        $name = $row['category_name'];
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php $_SERVER['PHP_SELF']  ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $id; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $name; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php } ?>
                <?php } ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
