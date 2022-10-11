<?php include "header.php"; ?>
<?php include "config.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            // define how many results you want per page
                            $results_per_page = 3;

                            // find out the number of results stored in database
                            $sql = 'SELECT * FROM  `post`';
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
                            $sql = 'SELECT * FROM `post` LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['post_id'];
                                    $title = $row['title'];
                                    $category = $row['category'];
                                    $date = $row['post_date'];
                                    $author = $row['author'];
                            ?>
                                    <td class='id'> <?php echo $id; ?></td>
                                    <td> <?php echo $title; ?></td>
                                    <td> <?php echo $category; ?></td>
                                    <td> <?php echo $date; ?></td>
                                    <td> <?php echo $author; ?></td>
                                    <td class='edit'><a href='update-post.php?post_id=<?php echo "$id" ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-post.php?post_id=<?php echo "$id" ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
            <ul class='pagination admin-pagination'>
                <?php
                for ($page = 1; $page <= $number_of_pages; $page++) {
                    
                        echo '<li><a class="active" href="post.php?page=' . $page . '">' . $page . '</a>  </li> ';
                
                }
                ?>
            </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>