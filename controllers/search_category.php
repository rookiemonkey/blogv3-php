<?php

    function search_category(){
        global $mysqli;

        $category_id = $_GET['c_id'];
        $post_status = 'published';

        $query = $mysqli->prepare("SELECT * FROM posts WHERE post_category_id = ? AND post_status = ?");

        $query->bind_param('is', $category_id, $post_status);

        $query->execute();

        $posts = $query->get_result();

        $query->close();

        if($posts->num_rows === 0) {
            render_alert_failed('No Results Found');
        }

        while($row = $posts->fetch_assoc()) { 
            $post_title = $row["post_title"];
            $post_author = $row["post_author"];
            $post_date = $row["post_date"];
            $post_content = substr($row["post_content"], 0, 200);
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

        <p><?php echo $post_content . '...' ?></p>

        <a class="btn btn-primary" href="#">
            Read More 
            <span class="glyphicon glyphicon-chevron-right">
            </span>
        </a>

        <hr>
<?php
        }
    }
?>