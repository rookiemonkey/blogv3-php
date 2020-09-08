<?php require 'vendor/autoload.php'; ?>
<?php View::MainHeader(); ?>
<?php View::Navigation(); ?>

<section id="login">    
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>

                <?php Controller::register(); ?>

                    <form role="form" action="registration.php" method="POST" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="firstname" class="sr-only">First Name</label>
                            <input type="text" name="user_firstname" id="firstname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">Last Name</label>
                            <input type="text" name="user_lastname" id="lastname" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="user_username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="user_password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                
                        <input type="submit" name="submit_register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register" required>
                    </form> 
                 
                </div>
            </div>
        </div>
    </div>
</section>

<hr>

<?php View::MainFooter(); ?>