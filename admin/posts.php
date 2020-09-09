<?php require '../vendor/autoload.php'; ?>
<?php AdminView::AdminHeader(); ?>

<div id="wrapper">

    <?php AdminView::AdminNavigation(); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Posts Dashboard
                    </h1>

                    <?php
                    if (isset($_GET['source'])) {
                        switch ($_GET['source']) {
                            case 'add_post':
                                AdminView::Post_addForm();
                                break;
                            case 'edit_post':
                                AdminView::Post_editForm();
                                break;
                            default:
                                AdminView::PostsPage();
                        }
                    } else {
                        AdminView::PostsPage();
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php AdminView::AdminFooter(); ?>