<?php  include "includes/database.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>

<section id="login">    
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>

                <?php

                    if(isset($_POST['submit_register'])) {
                        $user_firstname = $_POST['user_firstname'];
                        $user_lastname = $_POST['user_lastname'];
                        $user_username = $_POST['user_username'];;  
                        $user_email = $_POST['user_email'];
                        $user_password = $_POST['user_password'];

                        if(empty($user_firstname) || empty($user_lastname) || empty($user_username) || empty($user_email) || empty($user_password)) {
                            render_alert_failed('User informations cannot be empty');
                        }

                        else if (strlen($user_password) < 8) {
                            render_alert_failed('Passwords should have a minimum of 8 charactes');
                        }

                        else if (is_user_exisiting($user_email, $user_username)){
                            render_alert_failed('Username/Email already exists. Please provide a unique username and email');
                        }

                        else if (!is_user_exisiting($user_email, $user_username)) { 
                            $inputs = [
                                'firstname' => $user_firstname,
                                'lastname' => $user_lastname,
                                'username' => $user_username,
                                'email' => $user_email,
                                'password' => $user_password ,
                                'role' => 'subscriber',
                                'avatar' => 'test+avatar+jpg',
                                'randSalt' => 'test+randsalt',
                            ];

                            // create the user's account
                            $user_info = register_user($inputs);

                            // login and start the session
                            login_user($user_info['username'], $user_info['password']);

                            // check if query is successfull
                            if($user_info['result']) { 
                                header('Location: index.php');
                            }
                            
                            else { 
                                render_alert_failed('Something went wrong. Please try again');
                            }
                        }
                    }

                ?>

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
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<hr>

<?php include "includes/footer.php";?>