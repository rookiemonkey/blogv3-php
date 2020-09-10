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
                            <?php
                            if ($_SESSION['avatar'] === 'https://res.cloudinary.com/promises/image/upload/v1596613153/global_default_image.png') {
                            ?>
                                <img src="https://res.cloudinary.com/promises/image/upload/v1596613153/global_default_image.png" style="width: 20px; height:20px; border-radius: 20px" />
                            <?php } else { ?>
                                <img src="/cms/assets/images/avatars/<?php echo Utility::sanitize($_SESSION['avatar']) ?>" style="width: 20px; height:20px; border-radius: 20px" />
                            <?php } ?>
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