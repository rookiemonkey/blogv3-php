<?php require '../vendor/autoload.php'; ?>
<?php SubscriberView::SubscriberHeader(); ?>

<div id="wrapper">

    <?php SubscriberView::SubscriberNavigation(); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Subscriber Posts
                    </h1>

                    <?php
                    if (isset($_GET['source'])) {
                        switch ($_GET['source']) {
                            case 'add_post':
                                SubscriberView::Post_addForm();
                                break;
                            case 'edit_post':
                                SubscriberView::Post_editForm();
                                break;
                            default:
                                SubscriberView::PostsPage();
                        }
                    } else {
                        SubscriberView::PostsPage();
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php SubscriberView::SubscriberFooter(); ?>