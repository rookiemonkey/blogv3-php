<?php require '../vendor/autoload.php'; ?>
<?php AdminView::AdminHeader(); ?>

<div id="wrapper">

    <?php AdminView::AdminNavigation(); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Comments Dashboard
                    </h1>

                    <?php AdminView::CommentsPage(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php AdminView::AdminFooter(); ?>