<?php include 'header.php'; ?>
<?php include "admin/config.php"; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                    $id = $_GET['cid'];
                    $sql = "SELECT * FROM `category` WHERE category_id={$id}";
                    $result = mysqli_query($conn, $sql) or die("Query Failed. : catagory Post");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <h2 class="page-heading"><?php echo $row['category_name']; ?></h2>
                    <?php
                        }
                    }
                    ?>

                    <!-- pagination code  -->


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




                    <!-- pagination code ends  -->
                        <?php
                        $id = $_GET['cid'];
                        $sql = "SELECT post.post_id, post.title, post.description, post.post_date, post.author,
                        category.category_name,user.username,post.category,post.post_img FROM post
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id
                        WHERE post.category = {$id}
                        ORDER BY post.post_id DESC LIMIT {$this_page_first_result},{$results_per_page}";
                        $result = mysqli_query($conn, $sql) or die("Query Failed. : Recent Post");
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='<a href="single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php'><?php echo $row['author']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo $row['description']; ?>
                                            </p>
                                            <a class='read-more pull-right' href='<a href="single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }  ?>
                    <?php }else{
                        echo '<h1>No Records Founds.....!</h1>';
                    } ?>
                </div>
                
                <hr>
                <ul class='pagination'>
                    <?php
                    for ($page = 1; $page <= $number_of_pages; $page++) {

                        echo '<li><a class="active" href="index.php?page=' . $page . '">' . $page . '</a>  </li> ';
                    }
                    ?>
                </ul>
                </div><!-- /post-container -->
            <?php include 'sidebar.php'; ?>
        </div>
        
    </div>
</div>
<?php include 'footer.php'; ?>