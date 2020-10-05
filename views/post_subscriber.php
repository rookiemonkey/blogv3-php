<?php

function render_post_subscriber()
{
    $mysqli = Model::Provide_Database();

    $post_id = $_GET['p_id'];
    $post_status = 'published';

    $stmt = "SELECT * FROM posts WHERE post_id = ? AND post_status = ?";
    $query = $mysqli->prepare($stmt);
    $query->bind_param('ss', $post_id, $post_status);
    $query->execute();
    $posts = $query->get_result();
    $query->close();

    if ($posts->num_rows !== 0) {
        // update view count on database
        $stmt = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = ?";
        $views_query = $mysqli->prepare($stmt);
        $views_query->bind_param('s', $post_id);
        $views_query->execute();
        $views_query->close();
    }

    if ($posts->num_rows === 0) {
        header('Location: /index');
    }

    while ($row = $posts->fetch_assoc()) {
        $post_title = Utility::sanitize($row["post_title"]);
        $post_author = Utility::sanitize($row["post_author"]);
        $post_date = Utility::sanitize($row["post_date"]);
        $post_content = Utility::sanitize($row["post_content"]);
        $post_image = Utility::sanitize($row["post_image"]);
        $post_likes = Utility::sanitize($row["post_likes"]);
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
        <img class="img-responsive" src="/assets/images/posts/<?php echo $post_image ?>" alt="<?php echo $post_title ?>">
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
            if (Utility::isLoggedIn()) {
                if ($results->num_rows === 0) {
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

            <button class="btn btn-info">
                Likes: <?php echo $post_likes ?>
            </button>

            <?php if (
                Utility::isLoggedIn() &&
                isset($_GET['p_id']) &&
                $post_author === $_SESSION['username']
            ) { ?>
                <button type="button" class="btn btn-warning">
                    <a id='btn_edit' href="/subscriber/posts.php?source=edit_post&p_id=<?php echo Utility::sanitize($_GET['p_id']); ?>">
                        Edit Post
                    </a>
                </button>
            <?php } ?>

        </div>

        <hr>
<?php
    }
}
?>