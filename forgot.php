<?php include "./includes/database.php"; ?>
<?php include "./includes/header.php"; ?>

<!-- Navigation -->
<?php include "./includes/navigation.php" ?>

<?php

    if(!isMethod('GET') && !isset($_GET['token'])) {
        redirect('index');
    }

?>

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
                                                if(isset($_POST['email'])) {
                                                    $email = $_POST['email'];
                                                    $token = bin2hex(openssl_random_pseudo_bytes(50));

                                                    if(is_user_exisiting($email, "null")) {
                                                        $query = $mysqli->prepare("UPDATE users SET user_token = ? WHERE user_email = ?");
                                                        $query->bind_param('ss', $token, $email);
                                                        $query->execute();
                                                        $query->close();
                                                        toEmailPasswordReset($email);
                                                        render_alert_success('Success! Password rest link sent to your email.');
                                                    }

                                                    else {
                                                        render_alert_failed('Failed. Incorrect email provided');
                                                    }
                                                }
                                            }
                                        ?>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
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