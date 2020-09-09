<?php
AdminUsers::update();

if (isset($_GET['u_id'])) {
    $mysqli = AdminModel::Provide_Database();

    // prepare statement and query
    $query = $mysqli->prepare("SELECT * FROM users WHERE user_id = ?");
    $query->bind_param('s', $_GET['u_id']);
    $query->execute();
    $user = $query->get_result();
    $user_row = $user->fetch_assoc();
    $query->close();

    if (!$user_row) {
        header('Location: /cms/admin/users.php');
        die();
    }

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
            <label for="role">Role</label>
            <select name="user_role" style="display: block;">

                <?php AdminUtilities::render_RoleOptionsEdit($user_row); ?>

            </select>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" class="form-control" name="user_email" value="<?php echo Utility::sanitize($user_row['user_email']); ?>" required>
        </div>

        <div class="form-group">
            <input type="submit" name="update_user" value="Update User">
        </div>

    </form>

<?php
}
?>