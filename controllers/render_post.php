<?php

    function render_post() {
        global $mysqli;

        $post_id = $_GET['p_id'];
        $post_status = 'published';

        // update view count on database
        $views_query = $mysqli->prepare("UPDATE posts SET post_views = post_views + 1 WHERE post_id = ?");
        $views_query->bind_param('s', $post_id);
        $views_query->execute();
        $views_query->close();

        $query = $mysqli->prepare("SELECT * FROM posts WHERE post_id = ? AND post_status = ?");
        $query->bind_param('ss', $post_id, $post_status);
        $query->execute();
        $posts = $query->get_result();
        $query->close();

        while($row = $posts->fetch_assoc()) { 
            $post_title = $row["post_title"];
            $post_author = $row["post_author"];
            $post_date = $row["post_date"];
            $post_content = $row["post_content"];
            $post_image = $row["post_image"];   
            $post_likes = $row["post_likes"];   
            
?>
            <h1 class="page-header">
                Page Heading    
                <small>Secondary Text</small>
            </h1>
            
            <h2>
                <a><?php echo $post_title ?></a>
            </h2>

            <p class="lead">
                by <a href="/author.php"><?php echo $post_author ?></a>
            </p>

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
                <button id="btn_like" type="button" class="btn btn-primary">Like</button>
                Likes: <?php echo $post_likes ?>
            </div>

            <hr>
<?php                          
        }
    }
?>
