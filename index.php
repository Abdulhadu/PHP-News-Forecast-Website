<?php include 'header.php'; ?>
<?php include "admin/config.php"; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

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
                            $desc = $row['description'];
                            $image = $row['post_img'];
                    ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" style="height: 145px; " href="single.php"><img src="admin/upload/<?php echo $image ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php'><?php echo $title ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php'><?php echo $category ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php'><?php echo   $author ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo  $date ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo $desc ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }  ?>
                    <?php } ?>
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