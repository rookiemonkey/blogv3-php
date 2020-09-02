<?php include './includes/admin_header.php' ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include './includes/admin_navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin Dashboard
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                <div class='huge'>
            <?php
                $query = $mysqli->prepare("SELECT * FROM posts");
                $query->execute();
                $posts = $query->get_result();
                $query->close();
                echo $posts->num_rows;
            ?>
                                </div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'>
            <?php
                $query = $mysqli->prepare("SELECT * FROM comments");
                $query->execute();
                $comments = $query->get_result();
                $query->close();
                echo $comments->num_rows;
            ?>
                                    </div>
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'>
            <?php
                $query = $mysqli->prepare("SELECT * FROM users");
                $query->execute();
                $users = $query->get_result();
                $query->close();
                echo $users->num_rows;
            ?>
                                    </div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
            <?php
                $query = $mysqli->prepare("SELECT * FROM categories");
                $query->execute();
                $categories = $query->get_result();
                $query->close();
                echo $categories->num_rows;
            ?>
                                        </div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <?php
                    $draft = 'draft';
                    $query = $mysqli->prepare("SELECT * FROM posts WHERE post_status = ?");
                    $query->bind_param('s', $draft);
                    $query->execute();
                    $draft_posts = $query->get_result();
                    $query->close();
                    $draft_posts_count = $draft_posts->num_rows;

                    $published = 'draft';
                    $query = $mysqli->prepare("SELECT * FROM posts WHERE post_status = ?");
                    $query->bind_param('s', $published);
                    $query->execute();
                    $published_posts = $query->get_result();
                    $query->close();
                    $published_posts_count = $published_posts->num_rows;

                    $unapproved = 'unapproved';
                    $query = $mysqli->prepare("SELECT * FROM comments WHERE comment_status = ?");
                    $query->bind_param('s', $unapproved);
                    $query->execute();
                    $unapproved_comments = $query->get_result();
                    $query->close();
                    $unapproved_comments_count = $unapproved_comments->num_rows;

                    $approved = 'approved';
                    $query = $mysqli->prepare("SELECT * FROM comments WHERE comment_status = ?");
                    $query->bind_param('s', $approved);
                    $query->execute();
                    $aprroved_comments = $query->get_result();
                    $query->close();
                    $aprroved_comments_count = $aprroved_comments->num_rows;

                    $subscriber = 'subscriber';
                    $query = $mysqli->prepare("SELECT * FROM users WHERE user_role = ?");
                    $query->bind_param('s', $subscriber);
                    $query->execute();
                    $subscriber_users = $query->get_result();
                    $query->close();
                    $subscriber_users_count = $subscriber_users->num_rows;

                    $admin = 'admin';
                    $query = $mysqli->prepare("SELECT * FROM users WHERE user_role = ?");
                    $query->bind_param('s', $admin);
                    $query->execute();
                    $admin_users = $query->get_result();
                    $query->close();
                    $admin_users_count = $admin_users->num_rows;
                ?>


                <div class="row">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],
                        <?php
                            echo "['Posts (All', $posts->num_rows],";
                            echo "['Posts (Published)', $published_posts_count],";
                            echo "['Posts (Draft)', $draft_posts_count],";
                            echo "['Comments (All)', $comments->num_rows],";
                            echo "['Comments (Approved)', $aprroved_comments_count],";
                            echo "['Comments (Unapproved)', $unapproved_comments_count],";
                            echo "['Users (All)', $users->num_rows],";
                            echo "['Users (Admin)', $admin_users_count],";
                            echo "['Users (Subscriber)', $subscriber_users_count],";
                            echo "['Categories', $categories->num_rows],";
                        ?>
                        ]);

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data);
                    }
                    </script>

                    <div id="columnchart_material" style="width: 100%; height: 500px;">
                </div>
                </div>

            </div>
        </div>
    </div>

<?php include "./includes/admin_footer.php" ?>