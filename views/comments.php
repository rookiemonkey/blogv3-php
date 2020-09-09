<?php

    function render_comments() {
        $mysqli = Model::Provide_Database();

        $p_id = $_GET['p_id'];
        $comment_status = 'approved';
        $query = $mysqli->prepare("SELECT * FROM comments WHERE comment_post = ? AND comment_status = ? ORDER BY comment_id DESC");
        $query->bind_param('is', $p_id, $comment_status);
        $query->execute();
        $comments = $query->get_result();
        $query->close();

        while($row = $comments->fetch_assoc()) {
            $comment_author = Utility::sanitize($row['comment_author']);
            $comment_content = Utility::sanitize($row['comment_content']);
            $comment_date = Utility::sanitize($row['comment_date']);
?>
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $comment_author; ?>
                    <small><?php echo $comment_date; ?></small>
                </h4>
                <?php echo $comment_content; ?>
            </div>
        </div>
<?php
        }
    }
?>