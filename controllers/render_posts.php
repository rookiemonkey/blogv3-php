<?php

    // should be converted to a function because of
    // variable scoping issues

    include './controllers/pagination_vars.php';

    $post_status = 'published';
    $query = $mysqli->prepare("SELECT * FROM posts WHERE post_status = ? LIMIT ?, ?");
    $query->bind_param('sii', $post_status, $page_1, $post_per_page);
    $query->execute();
    $posts = $query->get_result();
    $query->close();

    while($row = $posts->fetch_assoc()) {
        $post_id = $row["post_id"];
        $post_title = $row["post_title"];
        $post_author = $row["post_author"];
        $post_date = $row["post_date"];
        $post_content = substr($row["post_content"], 0, 200);
        $post_image = $row["post_image"];   
?>
    <h2>
        <a href="/_PHP_blog/post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
    </h2>

    <p class="lead">
        by <a href="/_PHP_blog/author.php?author='<?php echo $post_author ?>"><?php echo $post_author ?></a>
    </p>

    <p>
        <span class="glyphicon glyphicon-time"></span> 
        Posted on <?php echo $post_date ?>
    </p>

    <hr>
        <!-- the image name on database should match the one on the file system -->
        <a href="/_PHP_blog/post.php?p_id=<?php echo $post_id ?>">
            <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="<?php echo $post_title ?>">
        </a>
    <hr>

    <p><?php echo $post_content . '...' ?></p>

    <a class="btn btn-primary" href="/_PHP_blog/post.php?p_id=<?php echo $post_id ?>">
        Read More 
        <span class="glyphicon glyphicon-chevron-right">
        </span>
    </a>

    <hr>
<?php 
    }
?>