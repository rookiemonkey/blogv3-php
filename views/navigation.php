<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#dropdown_navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/cms/">Logo</a>
        </div>

        <div class="collapse navbar-collapse" id="dropdown_navigation">
            <ul class="nav navbar-nav">

                <?php if (isset($_SESSION['username'])) { ?>
                    <li>
                        <a>
                            Good day! <?php echo Utility::sanitize($_SESSION['username']); ?>
                            <?php View::Avatar($_SESSION['avatar'], '24px'); ?>
                        </a>
                    </li>
                <?php } ?>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                    <li>
                        <a href='/cms/admin/index.php'>
                            Admin
                        </a>
                    </li>
                <?php } ?>

                <?php if (Utility::isLoggedIn()) {  ?>
                    <li>
                        <a href='/cms/api/logout.php'>
                            Logout
                        </a>
                    </li>
                <?php } ?>

                <?php if (!Utility::isLoggedIn()) { ?>
                    <li>
                        <a href='/cms/registration'>
                            Register
                        </a>
                    </li>

                    <li>
                        <a href='/cms/login'>
                            Login
                        </a>
                    </li>
                <?php } ?>

                <li>
                    <a href='/cms/contact'>
                        Contact
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>