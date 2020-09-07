<?php include "./includes/database.php"; ?>
<?php include "./includes/header.php"; ?>

<!-- Navigation -->
<?php include "./includes/navigation.php" ?>

<?php
    if(!isset($_GET['email']) && !isset($_GET['token'])) {
        redirect('index');  
    }

    $query = $mysqli->prepare("SELECT user_email, user_token FROM users WHERE user_email = ? AND user_token = ?");
    $query->bind_param('ss', $_GET['email'], $_GET['token']);
    $query->execute();
    $users = $query->get_result();
    $query->close();

    if($users->num_rows === 0) {
        redirect('index');
    }
?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <?php
                                            if(isMethod('POST')) {
                                                if(isset($_POST['recover-submit'])) {
                                                    $new = $_POST['newpassword'];
                                                    $confirm = $_POST['confirmpassword'];
                                                    $email = $_GET['email'];
                                                    $token = '';

                                                    if($new !== $confirm) {
                                                        render_alert_failed("Failed. Passwords doesn't match");
                                                    }

                                                    else if (strlen($new) < 8) {
                                                        render_alert_failed('Failed. Passwords should have a minimum of 8 charactes');
                                                    }

                                                    else {
                                                        $new = password_hash($new, PASSWORD_BCRYPT, array('cost' => 12));

                                                        $statement = "UPDATE users SET user_password = ?, user_token = ? WHERE user_email = ?";

                                                        $query = $mysqli->prepare($statement);

                                                        $query->bind_param("sss", $new, $token, $email);

                                                        $query->execute();

                                                        $query->close();

                                                        render_alert_success('Success! Please login using your new password');
                                                    }

                                                }
                                            }
                                        ?>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></i></span>
                                                <input id="newpassword" name="newpassword" placeholder="New Password" class="form-control"  type="password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></i></span>
                                                <input id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" class="form-control"  type="password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

<?php include "includes/footer.php";?>
