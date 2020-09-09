<?php

    function render_post_subscriber() {
        $mysqli = Model::Provide_Database();

        $post_id = $_GET['p_id'];
        $post_status = 'published';

        $stmt = "SELECT * FROM posts WHERE post_id = ? AND post_status = ?";
        $query = $mysqli->prepare($stmt);
        $query->bind_param('ss', $post_id, $post_status);
        $query->execute();
        $posts = $query->get_result();
        $query->close();

        if($posts->num_rows !== 0) {
            // update view count on database
            $stmt = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = ?";
            $views_query = $mysqli->prepare($stmt);
            $views_query->bind_param('s', $post_id);
            $views_query->execute();
            $views_query->close();
        }

        if($posts->num_rows === 0) {
            View::alert_Failed('Post not found.');
        }

        while($row = $posts->fetch_assoc()) { 
            $post_title = $row["post_title"];
            $post_author = $row["post_author"];
            $post_date = $row["post_date"];
            $post_content = $row["post_content"];
            $post_image = $row["post_image"];   
            $post_likes = $row["post_likes"];   
            
?>
            <h1 class="page-header">
                <?php echo $post_title ?>    
                <small>by <?php echo $post_author ?></small>
            </h1>

            <p>
                <span class="glyphicon glyphicon-time"></span> 
                Posted on <?php echo $post_date ?>
            </p>

            <hr>
                <!-- the image name on database should match the one on the file system -->
                <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="<?php echo $post_title ?>">
            <hr>

            <p>
                <?php echo $post_content ?>
            </p>
            
            <div>
                <?php
                    // check if the user already liked the post
                    $isLiked = $mysqli->prepare("SELECT * FROM likes WHERE like_postid = ? AND like_userid = ?");
                    $isLiked->bind_param('ii', $post_id, $_SESSION['id']);
                    $isLiked->execute();
                    $results = $isLiked->get_result();
                    $isLiked->close();

                ?>

                <?php
                    if(Utility::isLoggedIn()) {
                        if($results->num_rows === 0) {
                ?>
                        <button id="btn_like" type="button" class="btn btn-primary" data-toggle="thumbsup" title="Give me a like Please!">
                            <i class="glyphicon glyphicon-thumbs-up"></i>
                            Like
                        </button>
                <?php
                        } else {
                ?>
                        <button id="btn_like" type="button" class="btn btn-primary" data-toggle="thumbsup" title="You've already given me a like">
                            <i class="glyphicon glyphicon-thumbs-up"></i>
                            Unlike
                        </button>
                <?php
                        }
                    }
                ?>
                
                Likes: <?php echo $post_likes ?>
            </div>

            <hr>
<?php                          
        }
    }
?>
