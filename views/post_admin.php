<?php

function render_post_admin()
{
    $mysqli = Model::Provide_Database();

    $post_id = $_GET['p_id'];
    $post_status = 'published';

    $stmt = "SELECT * FROM posts WHERE post_id = ?";
    $query = $mysqli->prepare($stmt);
    $query->bind_param('s', $post_id);
    $query->execute();
    $posts = $query->get_result();
    $query->close();

    while ($row = $posts->fetch_assoc()) {
        $post_title = Utility::sanitize($row["post_title"]);
        $post_author = Utility::sanitize($row["post_author"]);
        $post_date = Utility::sanitize($row["post_date"]);
        $post_content = Utility::sanitize($row["post_content"]);
        $post_image = Utility::sanitize($row["post_image"]);
        $post_likes = Utility::sanitize($row["post_likes"]);
        $post_status = Utility::sanitize($row["post_status"]);

?>
        <h1 class="page-header">
            <?php echo $post_title ?>
            <small>by <?php echo $post_author ?></small>
            <?php
            if ($post_status === 'draft') {
                echo '<span class="badge" style="background-color: #f0ad4e">Draft</span>';
            } else {
                echo '<span class="badge" style="background-color: #5cb85c">Published</span>';
            }
            ?>
        </h1>

        <p>
            <span class="glyphicon glyphicon-time"></span>
            Posted on <?php echo $post_date ?>
        </p>

        <div class="alert alert-warning" role="alert">
            <b>IMPORTANT!</b> This is an Admin's view. Hence, view counts are not counted and adding comments and likes are also disabled. If you want to add likes and comments, Please use your subscriber account.
        </div>

        <hr>
        <!-- the image name on database should match the one on the file system -->
        <img class="img-responsive" src="/cms/assets/images/<?php echo $post_image ?>" alt="<?php echo $post_title ?>">
        <hr>

        <p>
            <?php echo $post_content ?>
        </p>

        <div>
            <button class="btn btn-info">
                Likes: <?php echo $post_likes ?>
            </button>

            <button type="button" class="btn btn-warning">
                <a id='btn_edit' href="/cms/admin/posts.php?source=edit_post&p_id=<?php echo Utility::sanitize($_GET['p_id']); ?>">
                    Edit Post
                </a>
            </button>
        </div>

        <hr>
<?php
    }
}
?>