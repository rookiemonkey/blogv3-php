<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.php">
            CMS Subscriber
        </a>
    </div>

    <ul class="nav navbar-right top-nav">
        <li>
            <a>Online Users: <span class='usersonline'></span></a>
        </li>
        <li>
            <a href="../index.php">
                Home
            </a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php View::Avatar($_SESSION['avatar'], '24px') ?>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#">
                        <i class="fa fa-fw fa-user"></i>
                        <?php echo Utility::sanitize($_SESSION['firstname']); ?>
                    </a>
                </li>
                <li>
                    <a href="profile.php">
                        <i class="fa fa-fw fa-dashboard"></i>
                        Manage Profile
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href='/api/logout.php'>
                        <i class="fa fa-fw fa-power-off"></i>
                        Log Out
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="collapse navbar-collapse navbar-ex1-collapse" id="navigation_bar">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="./posts.php">
                    <i class="glyphicon glyphicon-list-alt"></i>
                    <span>&nbsp;</span>All Posts
                </a>
            </li>
            <li>
                <a href="./posts.php?source=add_post">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>&nbsp;</span>Add Post
                </a>
            </li>
            <li>
                <a href="./comments.php">
                    <i class="fa fa-fw fa-file"></i>
                    <span>&nbsp;</span>Comments
                </a>
            </li>
        </ul>
    </div>
</nav>