<?php

    function search_tags() {
        global $mysqli;
        
        $search =  $_POST["search"]; 
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published'";  
        $search_query = mysqli_query($mysqli, $query);

        if(!$search_query) {
            die("Query failed" . mysqli_error($mysqli));
        }

        $count = mysqli_num_rows($search_query);

        if($count === 0) {
            echo "<div class='panel panel-primary'>";
            echo "<div class='panel-heading'>";
            echo '<h3 class="panel-title">No Results Found</h3>';
            echo "</div>";
            echo "</div>";
        }

        while($row = mysqli_fetch_assoc($search_query)) {
            $post_title = $row['post_title'];
            $post_image = $row['post_image'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content'];
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

            <img class="img-responsive" src="./images/<?php echo $post_image ?>.png" alt="<?php echo $post_title ?>">
            
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
?>