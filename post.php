<?php include "./includes/database.php"; ?>
<?php include "./includes/header.php"; ?>
<?php include "./controllers/render_post.php"; ?>
<?php include "./controllers/render_comments.php"; ?>
<?php include "./controllers/add_comment.php"; ?>

    <!-- Navigation -->
    <?php include "./includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- Post -->
                <?php
                    if(isset($_GET['p_id'])) {
                        render_post();
                    }
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <?php
                        if(isset($_POST['create_comment'])) {
                            add_comment();
                        }
                    ?>
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="POSt">
                        <div class="form-group">
                            <label for="author">Author: </label>
                            <input name="comment_author" type='text' class="form-control" id="author" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input name="comment_email" type='email' class="form-control" id="email" required>
                        </div>  

                        <div class="form-group">
                            <label for="comment">Comment: </label>
                            <textarea name="comment_content" class="form-control" rows="3" id="comment"></textarea>
                        </div>

                        <button name="create_comment" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Comment -->
                <?php
                    if(isset($_GET['p_id'])) {
                        render_comments();
                    }
                ?>

            </div>
            
            <!-- Blog Sidebar Widgets Column -->
            <?php include "./includes/sidebar.php" ?>

        </div>

    <hr>

<?php include "./includes/footer.php" ?>