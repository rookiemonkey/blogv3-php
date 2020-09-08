<?php require 'vendor/autoload.php'; ?>
<?php View::MainHeader(); ?>
<?php View::Navigation(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">

            <h1 class="page-header">
                Author Search    
                <small>by <?php echo $_GET['author']; ?></small>
            </h1>

            <?php View::search_byAuthor(); ?>

            <ul class="pager">

                <?php View::Pagination(true); ?>
                
            </ul>

        </div>

        <?php View::SideBar(); ?>

    </div>
<hr>

<?php View::MainFooter(); ?>