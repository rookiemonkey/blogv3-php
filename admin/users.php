<?php require '../vendor/autoload.php'; ?>
<?php AdminView::AdminHeader(); ?>

<div id="wrapper">

    <?php AdminView::AdminNavigation(); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Users Dashboard
                    </h1>

                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];

                        switch ($source) {
                            case 'add_user':
                                AdminView::User_addForm();
                                break;
                            case 'edit_user':
                                AdminView::User_editForm();
                                break;
                            default:
                                AdminView::UsersPage();
                        }
                    } else {
                        AdminView::UsersPage();
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php AdminView::AdminFooter(); ?>