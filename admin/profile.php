<?php require '../vendor/autoload.php'; ?>
<?php AdminView::AdminHeader(); ?>

<div id="wrapper">

    <?php AdminView::AdminNavigation(); ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Admin Profile Page
                    </h1>

                    <?php AdminUsers::update_Current(); ?>
                    <?php AdminUsers::update_CurrentPassword(); ?>

                    <?php

                    if (isset($_SESSION['username'])) {
                        $mysqli = AdminModel::Provide_Database();
                        $username = $_SESSION['username'];
                        $query = $mysqli->prepare("SELECT * FROM users WHERE user_username = ?");
                        $query->bind_param('s', $username);
                        $query->execute();
                        $user = $query->get_result();
                        $query->close();

                        while ($user_row = $user->fetch_assoc()) {

                    ?>

                            <form action="" method="POST">

                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" id="firstname" class="form-control" name="user_firstname" value="<?php echo Utility::sanitize($user_row['user_firstname']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" id="lastname" class="form-control" name="user_lastname" value="<?php echo Utility::sanitize($user_row['user_lastname']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" class="form-control" name="user_username" value="<?php echo Utility::sanitize($user_row['user_username']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="form-control" name="user_email" value="<?php echo Utility::sanitize($user_row['user_email']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="update_user" value="Update User" class="btn btn-primary">
                                </div>

                            </form>

                    <?php
                        }
                    }
                    ?>

                    <button class="btn btn-sm btn-info pull-right m4" style="margin: 0px 5px;" data-target="#change_avatar" data-toggle="modal">
                        Change Avatar
                    </button>

                    <button class="btn  btn-sm btn-info pull-right m4" style="margin: 0px 5px;" data-target="#change_password" data-toggle="modal">
                        Change Password
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="change_password">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Change Password</h3>
            </div>
            <form action='' method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="password" name="new_password" placeholder="New Password" style="width: 100%" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" style="width: 100%" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="update_password" value="Update" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="change_avatar">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Change Avatar</h3>
            </div>
            <div class="modal-body">
                <h5>Modal Body</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a>
                    <button type="button" class="btn btn-primary">Confirm</button>
                </a>
            </div>
        </div>
    </div>
</div>

<?php AdminView::AdminFooter(); ?>