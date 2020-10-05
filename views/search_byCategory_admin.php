<?php

function search_category_admin()
{
    $mysqli = Model::Provide_Database();
    $vars = View::Pagination();

    if (!isset($_GET['c_id'])) {
        header('Location: /index');
    }

    $page_1 = $vars['page_1'];
    $post_per_page = $vars['post_per_page'];
    $category_id = $_GET['c_id'];

    $query = $mysqli->prepare("SELECT * FROM posts WHERE post_category_id = ? LIMIT ?, ?");

    $query->bind_param('iii', $category_id, $page_1, $post_per_page);

    $query->execute();

    $posts = $query->get_result();

    $query->close();

    if ($posts->num_rows === 0) {
        View::alert_Failed('No Results Found');
    }

    while ($row = $posts->fetch_assoc()) {
        $post_id = Utility::sanitize($row["post_id"]);
        $post_title = Utility::sanitize($row["post_title"]);
        $post_author =  Utility::sanitize($row["post_author"]);
        $post_date =  Utility::sanitize($row["post_date"]);
        $post_content =  Utility::sanitize(substr($row["post_content"], 0, 200));
        $post_image =  Utility::sanitize($row["post_image"]);
        $post_status = Utility::sanitize($row["post_status"]);
?>
        <h2>
            <a href="/post/<?php echo $post_id ?>">
                <?php echo $post_title ?>
                <?php
                if ($post_status === 'draft') {
                    echo '<span class="badge" style="background-color: #f0ad4e">Draft</span>';
                } else {
                    echo '<span class="badge" style="background-color: #5cb85c">Published</span>';
                }
                ?>
            </a>
        </h2>

        <p class="lead">
            by <a href="/author/<?php echo $post_author ?>">
                <?php echo $post_author ?>
            </a>

            <small class="pull-right">
                <span class="glyphicon glyphicon-time"></span>
                Posted on <?php echo $post_date ?>
            </small>
        </p>

        <hr>
        <!-- the image name on database should match the one on the file system -->
        <a href="/post/<?php echo $post_id ?>">
            <img class="img-responsive" src="/assets/images/posts/<?php echo $post_image ?>" alt="<?php echo $post_title ?>">
        </a>
        <hr>

        <p><?php echo $post_content . '...' ?></p>

        <a class="btn btn-primary" href="/post/<?php echo $post_id ?>">
            Read More
            <span class="glyphicon glyphicon-chevron-right">
            </span>
        </a>

        <hr>
<?php
    }
}
?>