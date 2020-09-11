<?php require '../vendor/autoload.php'; ?>
<?php SubscriberView::SubscriberHeader(); ?>

<div id="wrapper">

    <?php SubscriberView::SubscriberNavigation(); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Subscriber Post Comments

                        <?php if (isset($_GET['comments_of_post'])) {
                            $mysqli = SubscriberModel::Provide_Database();
                            $stmt = "SELECT post_title FROM posts WHERE post_id = ?";
                            $query = $mysqli->prepare($stmt);
                            $query->bind_param('s', $_GET['comments_of_post']);
                            $query->execute();
                            $posts = $query->get_result();
                            $post_row = $posts->fetch_assoc();
                            echo "<small>for: {$post_row['post_title']}</small>";
                        } ?>

                    </h1>

                    <?php SubscriberView::CommentsPage(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php SubscriberView::SubscriberFooter(); ?>