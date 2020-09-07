<?php include "./includes/database.php"; ?>
<?php include "./includes/header.php"; ?>
<?php include "./controllers/render_post.php"; ?>
<?php include "./controllers/render_comments.php"; ?>
<?php include "./controllers/add_comment.php"; ?>

<?php
    if(isset($_POST['likedby'])) {
        $post_id = $_GET['p_id'];
        $user_id = intval($_POST['likedby']);
        $user_username = $_POST['username'];

        // increment the post_likes col
        $views_query = $mysqli->prepare("UPDATE posts SET post_likes = post_likes + 1 WHERE post_id = ?");
        $views_query->bind_param('s', $post_id);
        $views_query->execute();
        $views_query->close();
    }
?>

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



<?php
    if(isLoggedIn()) {
?>
    <script>
        $(document).ready(function() {
            $('#btn_like').on('click', function() {
                let userId = <?php echo $_SESSION['id']; ?>;
                let userName = "<?php echo $_SESSION['username']; ?>";

                $.ajax({
                    url: '/cms/post.php?p_id=<?php echo $_GET['p_id']; ?>',
                    type: 'POST',
                    data: { 
                        likedby: userId,
                        username: userName
                    }
                })
            })
        })
    </script>
<?php
    }
?>

<?php include "./includes/footer.php" ?>
