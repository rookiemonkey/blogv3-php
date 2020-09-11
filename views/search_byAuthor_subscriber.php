<?php

function search_author_subscriber()
{
    $mysqli = Model::Provide_Database();
    $vars = View::Pagination();

    if (!isset($_GET["author"])) {
        header('Location: /cms/index');
    }

    $page_1 = intval($vars['page_1']);
    $post_per_page = intval($vars['post_per_page']);
    $author =  "%{$_GET['author']}%";
    $post_status = 'published';

    $stmt = "SELECT * FROM posts WHERE post_status = ? AND post_author LIKE ? LIMIT ?, ?";

    $query = $mysqli->prepare($stmt);

    $query->bind_param('ssii', $post_status, $author, $page_1, $post_per_page);

    $query->execute();

    $posts = $query->get_result();

    $query->close();

    if ($posts->num_rows === 0) {
        View::alert_Failed('No Results Found');
    }

    while ($row = $posts->fetch_assoc()) {
        $post_id = Utility::sanitize($row["post_id"]);
        $post_title = Utility::sanitize($row['post_title']);
        $post_image = Utility::sanitize($row['post_image']);
        $post_author = Utility::sanitize($row['post_author']);
        $post_date = Utility::sanitize($row['post_date']);
        $post_content = Utility::sanitize($row['post_content']);
?>
        <h2>
            <a href="/cms/post/<?php echo $post_id ?>">
                <?php echo $post_title ?>
            </a>
        </h2>

        <p>
            <span class="glyphicon glyphicon-time"></span>
            Posted on <?php echo $post_date ?>

            <small class="pull-right">
                <span class="glyphicon glyphicon-time"></span>
                Posted on <?php echo $post_date ?>
            </small>
        </p>

        <hr>

        <a href="/cms/post/<?php echo $post_id ?>">
            <img class="img-responsive" src="/cms/assets/images/posts/<?php echo $post_image ?>" alt="<?php echo $post_title ?>">
        </a>

        <hr>

        <p><?php echo $post_content ?></p>

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