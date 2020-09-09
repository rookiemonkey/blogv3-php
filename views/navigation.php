<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/cms/">Logo</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li>
                    <a>
                        Good day! <?php echo Utility::sanitize($_SESSION['username']); ?>
                    </a>
                </li>

                <?php if (Utility::isAdmin()) { ?>
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