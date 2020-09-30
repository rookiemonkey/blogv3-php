<?php SubscriberPosts::options(); ?>

<form action="" method="POST">

    <?php
    $mysqli = SubscriberModel::Provide_Database();
    $query = $mysqli->prepare("SELECT * FROM posts WHERE post_author = ?");
    $query->bind_param('s', $_SESSION['username']);
    $query->execute();
    $posts = $query->get_result();
    $query->close();
    if ($posts->num_rows > 0) {
    ?>
        <div class="form-group">
            <div id="bulkOptionsContainer" class="col-xs-4">
                <select class="form-control" name="bulkOption" id="">
                    <option value="" selected>Bulk Option</option>
                    <option value="draft">Drafts</option>
                    <option value="published">Published</option>
                    <option value="delete">Delete</option>
                    <option value="clone">Clone</option>
                    <option value="reset views">Reset Views</option>
                </select>
            </div>

            <div id="bulkOptionsContainer" class="col-xs-4">
                <input type="submit" class="btn btn-success" value="Apply">
                <a href="posts.php?source=add_post" class="btn btn-primary">Add Post</a>
            </div>
        </div>
    <?php
    }
    ?>


    <table class='table table-hover table-bordered'>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Post ID</th>
                <th>Date</th>
                <th>Views</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>

            <?php
            SubscriberView::PostsTable();
            SubscriberPosts::delete();
            ?>

        </tbody>
    </table>
</form>