

<form action="" method="POST">    

    <?php create_user(); ?>
     
    <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" id="firstname" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" class="form-control" name="user_username">
    </div>

    <div class="form-group">
        <label for="role" style="display: block;">Role</label>
        <select name="user_role">
            <option value="subscriber">Select Role</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input type="submit" name="create_user" value="Create User">
    </div>

</form>
