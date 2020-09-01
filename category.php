<?php include "./includes/database.php"; ?>
<?php include "./includes/header.php" ?>

    <!-- Navigation -->
    <?php include "./includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading    
                    <small>Secondary Text</small>
                </h1>

                <!-- Post -->
                <?php
                
                    if(isset($_GET['c_id'])) {
                        $category_id = $_GET['c_id'];

                        $query = $mysqli->prepare("SELECT * FROM posts WHERE post_category_id = ?");
                        $query->bind_param('i', $category_id);
                        $query->execute();
                        $posts = $query->get_result();
                        $query->close();

                        if($posts->num_rows === 0) {
                            echo "<div class='panel panel-primary'>";
                            echo "<div class='panel-heading'>";
                            echo '<h3 class="panel-title">No Results Found</h3>';
                            echo "</div>";
                            echo "</div>";
                        }

                        while($row = $posts->fetch_assoc()) { 
                            $post_title = $row["post_title"];
                            $post_author = $row["post_author"];
                            $post_date = $row["post_date"];
                            $post_content = $row["post_content"];
                            $post_image = $row["post_image"];   
                            
                ?>
                            <h2>
                                <a href="#"><?php echo $post_title ?></a>
                            </h2>

                            <p class="lead">
                                by <a href="index.php"><?php echo $post_author ?></a>
                            </p>

                            <p>
                                <span class="glyphicon glyphicon-time"></span> 
                                Posted on <?php echo $post_date ?>
                            </p>

                            <hr>
                                <!-- the image name on database should match the one on the file system -->
                                <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="<?php echo $post_title ?>">
                            <hr>

                            <p><?php echo $post_content ?></p>

                            <a class="btn btn-primary" href="#">
                                Read More 
                                <span class="glyphicon glyphicon-chevron-right">
                                </span>
                            </a>

                            <hr>

                <?php                          
                        }
                    }
                    
                    else {
                        die();
                    }
                ?>

            </div>
            

            <!-- Blog Sidebar Widgets Column -->
            <?php include "./includes/sidebar.php" ?>

        </div>

    <hr>

<?php include "./includes/footer.php" ?>