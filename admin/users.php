<?php include "header.php"; ?>
<?php include "config.php"; ?>


<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <tr>

                            <?php
                            // define how many results you want per page
                            $results_per_page = 3;

                            // find out the number of results stored in database
                            $sql = 'SELECT * FROM  `user`';
                            $result = mysqli_query($conn, $sql);
                            $number_of_results = mysqli_num_rows($result);

                            // determine number of total pages available
                            $number_of_pages = ceil($number_of_results / $results_per_page);

                            // determine which page number visitor is currently on
                            if (!isset($_GET['page'])) {
                                $page = 1;
                            } else {
                                $page = $_GET['page'];
                            }

                            // determine the sql LIMIT starting number for the results on the displaying page
                            $this_page_first_result = ($page - 1) * $results_per_page;
                            ?>
                            <?php
                            $sql = 'SELECT * FROM `user`LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['user_id'];
                                    $fname = $row['first_name'];
                                    $lname = $row['last_name'];
                                    $username = $row['username'];
                                    $role = $row['role'];
                            ?>
                                    <td class='id'><?php echo $id; ?></td>
                                    <td><?php echo $fname ."-". $lname; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td><?php if ($role == 0) {
                                            echo 'Normal User';
                                        } else {
                                            echo 'Admin';
                                        }
                                        ?></td>
                                    <td class='edit'><a href='update-user.php?user_id=<?php echo "$id" ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-user.php?user_id=<?php echo "$id" ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
            <ul class='pagination admin-pagination'>
           
                    <?php
                    for ($page = 1; $page <= $number_of_pages; $page++) {
                        echo '<li><a class="active" href="users.php?page=' . $page . '">' . $page . '</a>  </li> ';
                    }
                    ?>
          
            </ul>
            </div>
        </div>
    </div>

</div>
<?php include "footer.php"; ?>