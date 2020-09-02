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
                        $user_username = $_POST['user_username'];
                        $user_role = 'subscriber';  
                        $user_email = $_POST['user_email'];
                        $user_password = $_POST['user_password'];
                        $user_avatar = "test+image+page";
                        $user_randSalt = "test+random+salt";

                        if(empty($user_firstname) || empty($user_lastname) || empty($user_username) || empty($user_email) || empty($user_password)) {
                            echo "<div class='panel panel-danger'>";
                            echo "<div class='panel-heading'>";
                            echo "<h3 class='panel-title'>Please provide valid informations</h3>";
                            echo "</div>";
                            echo "</div>";
                        }

                        else {
                            $hash = "$2y$10$";
                            $salt = "a3s12af8dlfjhlkjhasd8709832f"; 
                            $hash_salt = $hash . $salt;
                            $user_password = crypt($user_password, $hash_salt);

                            $query = $mysqli->prepare("INSERT INTO users (user_firstname, user_lastname, user_username, user_role, user_email, user_password, user_avatar, user_randSalt) VALUES (?,?,?,?,?,?,?,?)");
                            $query->bind_param('ssssssss', $user_firstname, $user_lastname, $user_username, $user_role, $user_email, $user_password, $user_avatar, $user_randSalt);
                            $result = $query->execute();

                            // check if query is successfull
                            if($result) { 
                                echo "<div class='panel panel-success'>";
                                echo "<div class='panel-heading'>";
                                echo "<h3 class='panel-title'>Succesfully registered. Please login</h3>";
                                echo "</div>";
                                echo "</div>";
                            }
                            else { 
                                echo "<div class='panel panel-danger'>";
                                echo "<div class='panel-heading'>";
                                echo "<h3 class='panel-title'>Something went wrong. Please try again later</h3>";
                                echo "</div>";
                                echo "</div>";
                            }
                        }
                        
                        $query->close();
                    }

                ?>

                    <form role="form" action="registration.php" method="POST" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="firstname" class="sr-only">First Name</label>
                            <input type="text" name="user_firstname" id="firstname" class="form-control" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">Last Name</label>
                            <input type="text" name="user_lastname" id="lastname" class="form-control" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="user_username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit_register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form> 
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<hr>

<?php include "includes/footer.php";?>