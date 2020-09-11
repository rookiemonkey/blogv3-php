<?php require 'vendor/autoload.php'; ?>
<?php View::MainHeader(); ?>
<?php View::Navigation(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-header">
                Category Search
                <small>
                    <?php Utility::getCategoryName($_GET['c_id']) ?>
                </small>
            </h1>

            <!-- REMINDER FOR ADMIN VIEW -->
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                <div class="alert alert-warning" role="alert">
                    <b>IMPORTANT!</b> Posts are being viewed as an admin. These includes both drafts and unplublished posts.
                </div>
            <?php } ?>

            <?php View::search_byCategory(); ?>

            <ul class="pager">

                <?php View::Pagination(true); ?>

            </ul>

        </div>

        <?php View::SideBar(); ?>

    </div>
    <hr>

    <?php View::MainFooter(); ?>