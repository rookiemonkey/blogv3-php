<?php include "./includes/database.php"; ?>
<?php include "./includes/header.php" ?>

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
                <?php include "./includes/posts.php" ?>

                <!-- Pager -->
                <ul class="pager">
                    <?php
                        
                        if($page > 1) {
                            echo "<li class='previous'><a href='index.php?page=1'><< Start</a></li>";
                        }

                        for ($i = 1; $i <= $page_last; $i++) {

                            if($i === $page - 1 && $page - 1 !== 0) {
                                echo "<li class='previous'><a href='index.php?page={$i}'>Previous</a></li>";
                            }
                            else if ($i === $page + 1) {
                                echo "<li class='next'><a href='index.php?page={$i}'>Next</a></li>";
                            }
                        }

                        if($page < $page_last ) {
                            echo "<li class='next'><a href='index.php?page={$page_last}'>Last >></a></li>";
                        }
                    ?>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "./includes/sidebar.php" ?>

        </div>

    <hr>

<?php include "./includes/footer.php" ?>