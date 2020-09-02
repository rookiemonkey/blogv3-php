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
                
                    if(isset($_GET['p_id'])) {
                        $post_id = $_GET['p_id'];

                        $query = $mysqli->prepare("SELECT * FROM posts WHERE post_id = ?");
                        $query->bind_param('s', $post_id);
                        $query->execute();
                        $posts = $query->get_result();
                        $query->close();

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

                            <hr>

                <?php                          
                        }
                    }
                    
                    else {
                        die();
                    }
                ?>


                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <?php
                
                        if(isset($_POST['create_comment'])) {
                            $comment_post = $_GET['p_id'];
                            $comment_author = $_POST['comment_author'];
                            $comment_email = $_POST['comment_email'];
                            $comment_content = $_POST['comment_content'];
                            $comment_date = date("Y-m-d");
                            $comment_status = "unapproved";

                            if($comment_author === '' || $comment_email === '' || 
                            $comment_content === ''
                            ) { die(); }

                            $statement = "INSERT INTO comments (comment_post, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES (?,?,?,?,?,?)";
                            $query = $mysqli->prepare($statement);
                            $query->bind_param("ssssss", $comment_post, $comment_author, $comment_email, $comment_content, $comment_status, $comment_date);
                            $result = $query->execute();

                            // check if query is successfull
                            if($result) { 
                                echo "<div class='panel panel-success'>";
                                echo "<div class='panel-heading'>";
                                echo "<h3 class='panel-title'>Succesfully added a comment</h3>";
                                echo "</div>";
                                echo "</div>";
                            }
                            else { 
                                echo "<div class='panel panel-danger'>";
                                echo "<div class='panel-heading'>";
                                echo "<h3 class='panel-title'>Something went wrong. Please try again later</h3>";
                                echo "</div>";
                                echo "</div>";
                            }

                            // close the connection to the database
                            $query->close();



                            // increment the comment count on post
                            $statement = "UPDATE posts SET post_comment_count  = post_comment_count + 1 WHERE post_id = ?";
                            $query = $mysqli->prepare($statement);
                            $query->bind_param("s", $comment_post);
                            $result = $query->execute();
                            $query->close();

                        }

                    ?>

                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="POSt">
                        <div class="form-group">
                            <label for="author">Author: </label>
                            <input name="comment_author" type='text' class="form-control" id="author" >
                        </div>

                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input name="comment_email" type='email' class="form-control" id="email">
                        </div>  

                        <div class="form-group">
                            <label for="comment">Comment: </label>
                            <textarea name="comment_content" class="form-control" rows="3" id="comment"></textarea>
                        </div>
                        <button name="create_comment" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->

                <?php 
                
                $p_id = $_GET['p_id'];
                $comment_status = 'approved';
                $query = $mysqli->prepare("SELECT * FROM comments WHERE comment_post = ? AND comment_status = ? ORDER BY comment_id DESC");
                $query->bind_param('is', $p_id, $comment_status);
                $query->execute();
                $comments = $query->get_result();

                
                while($row = $comments->fetch_assoc()) {
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];

                ?>

                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>
                    </div>

                <?php
                }

                $query->close();
                
                ?>

            </div>
            

            <!-- Blog Sidebar Widgets Column -->
            <?php include "./includes/sidebar.php" ?>

        </div>

    <hr>

<?php include "./includes/footer.php" ?>