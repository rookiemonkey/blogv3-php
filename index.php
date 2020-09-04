<?php include "./includes/database.php"; ?>
<?php include "./includes/header.php"; ?>
<?php include "./controllers/render_posts.php"; ?>
<?php include "./controllers/render_pagination.php"; ?>

    <!-- Navigation -->
    <?php include "./includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading    
                    <small>Secondary Text</small>
                </h1>

                <!-- Post -->
                <?php render_posts(); ?>

                <!-- Pager -->
                <ul class="pager">
                    <?php render_pagination(); ?>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "./includes/sidebar.php" ?>

        </div>

    <hr>

<?php include "./includes/footer.php" ?>