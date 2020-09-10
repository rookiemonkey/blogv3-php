<?php

    function render_posts_admin() {
        $mysqli = Model::Provide_Database();
        $vars = View::Pagination(false);

        $page_1 = $vars['page_1'];
        $post_per_page = $vars['post_per_page'];    
        $post_order = 'ASC';

        $stmt = "SELECT * FROM posts ORDER BY ? LIMIT ?, ?";

        $query = $mysqli->prepare($stmt);

        $query->bind_param('sii', $post_order, $page_1, $post_per_page);

        $query->execute();

        $posts = $query->get_result();

        $query->close();

        while($row = $posts->fetch_assoc()) {
            $post_id = Utility::sanitize($row["post_id"]);
            $post_title = Utility::sanitize($row["post_title"]);
            $post_author = Utility::sanitize($row["post_author"]);
            $post_date = Utility::sanitize($row["post_date"]);
            $post_content = Utility::sanitize(substr($row["post_content"], 0, 200));
            $post_image = Utility::sanitize($row["post_image"]); 
            $post_status = Utility::sanitize($row["post_status"]); 
?>
        <h2>  
            <a href="/cms/post/<?php echo $post_id ?>">
                <?php echo $post_title ?>
                <?php
                    if($post_status === 'draft') {
                        echo '<span class="badge" style="background-color: #f0ad4e">Draft</span>';
                    }
                    else {
                        echo '<span class="badge" style="background-color: #5cb85c">Published</span>';
                    }
                ?>
            </a>
        </h2>

        <p class="lead">
            by <a href="/cms/author/<?php echo $post_author ?>">
                <?php echo $post_author ?>
            </a>
            
            <small>
                <span class="glyphicon glyphicon-time"></span> 
                Posted on <?php echo $post_date ?>
            </small>
        </p>

        <hr>
            <!-- the image name on database should match the one on the file system -->
            <a href="/cms/post/<?php echo $post_id ?>">
                <img class="img-responsive" src="/cms/assets/images/posts/<?php echo $post_image ?>" alt="<?php echo $post_title ?>">
            </a>
        <hr>

        <p><?php echo $post_content . '...' ?></p>

        <a class="btn btn-primary" href="/cms/post/<?php echo $post_id ?>">
            Read More 
            <span class="glyphicon glyphicon-chevron-right">
            </span>
        </a>

        <hr>
<?php 
        }
    } 
?>