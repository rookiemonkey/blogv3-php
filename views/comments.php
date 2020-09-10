<?php

function render_comments()
{
    $mysqli = Model::Provide_Database();

    $p_id = $_GET['p_id'];
    $comment_status = 'approved';
    $query = $mysqli->prepare("SELECT * FROM comments WHERE comment_post = ? AND comment_status = ? ORDER BY comment_id DESC");
    $query->bind_param('is', $p_id, $comment_status);
    $query->execute();
    $comments = $query->get_result();
    $query->close();

    while ($row = $comments->fetch_assoc()) {
        $comment_author = Utility::sanitize($row['comment_author']);
        $comment_content = Utility::sanitize($row['comment_content']);
        $comment_date = Utility::sanitize($row['comment_date']);

        $query = $mysqli->prepare("SELECT user_avatar FROM users WHERE user_username = ?");
        $query->bind_param('s', $comment_author);
        $query->execute();
        $data = $query->get_result();
        $users = $data->fetch_assoc();
?>
        <div class="media">
            <a class="pull-left">
                <?php View::Avatar($users['user_avatar'], '64px'); ?>
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