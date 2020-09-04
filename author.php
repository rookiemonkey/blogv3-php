<?php include "./includes/database.php"; ?>
<?php include "./includes/header.php"; ?>
<?php include "./controllers/search_author.php"; ?>

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
                <?php
                    if(isset($_GET["author"])) {
                        search_author();
                    }
                ?>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "./includes/sidebar.php" ?>

        </div>

    <hr>

<?php include "./includes/footer.php" ?>