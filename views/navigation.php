<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#dropdown_navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Logo</a>
        </div>

        <div class="collapse navbar-collapse" id="dropdown_navigation">
            <ul class="nav navbar-nav">

                <?php if (isset($_SESSION['username'])) { ?>
                    <li>
                        <a>
                            <?php View::Avatar($_SESSION['avatar'], '24px'); ?>
                            Good day! <?php echo Utility::sanitize($_SESSION['username']); ?>
                        </a>
                    </li>
                <?php } ?>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                    <li>
                        <a href='/admin/index.php'>
                            Dashboard
                        </a>
                    </li>
                <?php } ?>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'subscriber') { ?>
                    <li>
                        <a href='/subscriber/posts.php'>
                            Dashboard
                        </a>
                    </li>
                <?php } ?>

                <?php if (Utility::isLoggedIn()) {  ?>
                    <li>
                        <a href='/api/logout.php'>
                            Logout
                        </a>
                    </li>
                <?php } ?>

                <?php if (!Utility::isLoggedIn()) { ?>
                    <li>
                        <a href='/registration'>
                            Register
                        </a>
                    </li>

                    <li>
                        <a href='/login'>
                            Login
                        </a>
                    </li>
                <?php } ?>

                <li>
                    <a href='/contact'>
                        Contact
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>