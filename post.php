<?php include "./includes/database.php"; ?>
<?php include "./includes/header.php"; ?>
<?php include "./controllers/render_post.php"; ?>
<?php include "./controllers/render_comments.php"; ?>
<?php include "./controllers/add_comment.php"; ?>

<?php
    if(isset($_POST['likedby'])) {
        $post_id = intval($_GET['p_id']);
        $user_id = intval($_POST['likedby']);

        // check if the user already liked the post
        $isLiked = $mysqli->prepare("SELECT * FROM likes WHERE like_postid = ? AND like_userid = ?");
        $isLiked->bind_param('ii', $post_id, $user_id);
        $isLiked->execute();
        $results = $isLiked->get_result();
        $isLiked->close();

        // not yet liked
        if($results->num_rows === 0) {
            // increment the post_likes col
            $add_like = $mysqli->prepare("UPDATE posts SET post_likes = post_likes + 1 WHERE post_id = ?");
            $add_like->bind_param('i', $post_id);
            $add_like->execute();
            $add_like->close();

            // save the like on likes table
            $save_like = $mysqli->prepare("INSERT INTO likes (like_postid, like_userid) VALUES (?,?)");
            $save_like->bind_param('ii', $post_id, $user_id);
            $save_like->execute();
            $save_like->close();
        }

        // already liked, remove like
        else {
            // decrement the post_likes col
            $add_like = $mysqli->prepare("UPDATE posts SET post_likes = post_likes - 1 WHERE post_id = ?");
            $add_like->bind_param('i', $post_id);
            $add_like->execute();
            $add_like->close();

            // purge the like on likes table
            $save_like = $mysqli->prepare("DELETE FROM likes WHERE like_postid = ? AND like_userid = ?");
            $save_like->bind_param('ii', $post_id, $user_id);
            $save_like->execute();
            $save_like->close();
        }
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
                    data: { likedby: userId }
                })
            })
        })
    </script>
<?php
    }
?>

<?php include "./includes/footer.php" ?>
