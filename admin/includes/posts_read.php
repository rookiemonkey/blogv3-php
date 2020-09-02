<?php  bulk_options_posts(); ?>

<form action="" method="POST">  

    <div id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulkOption" id="">
            <option value="" selected>Bulk Option</option>
            <option value="draft">Drafts</option>
            <option value="published">Published</option>
            <option value="delete">Delete</option>
        </select>
    </div>

    <div id="bulkOptionsContainer" class="col-xs-4">
        <input type="submit" class="btn btn-success" value="Apply">
        <a href="post_add.php" class="btn btn-primary">Add Post</a>
    </div>

    <table class='table table-hover table-bordered'>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Post ID</th>
                <th>Date</th>
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

            <?php delete_post(); ?>
            <?php read_posts(); ?>

        </tbody>
    </table>
</form>