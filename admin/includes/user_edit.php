<?php 
    update_user(); 

    if(isset($_GET['u_id'])) {
        // prepare statement and query
        $query = $mysqli->prepare("SELECT * FROM users WHERE user_id = ?");
        $query->bind_param('s', $_GET['u_id']);
        $query->execute();
        $user = $query->get_result();
        $user_row = $user->fetch_assoc();
        $query->close();
        
        if(!$user_row ) { header('Location: users.php'); die(); }
    
?>

    <form action="" method="POST">    

        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" class="form-control" name="user_firstname" value="<?php echo $user_row['user_firstname'] ?>">
        </div>

        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" class="form-control" name="user_lastname" value="<?php echo $user_row['user_lastname'] ?>">
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" class="form-control" name="user_username" value="<?php echo $user_row['user_username'] ?>">
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="user_role">
                <?php

                    if($user_row['user_role'] === 'subscriber') {
                        echo '<option value="subscriber" selected="selected">Subscriber</option>';
                        echo '<option value="admin">Admin</option>';
                    }

                    else if ($user_row['user_role'] === 'admin') {
                        echo '<option value="admin" selected="selected">Admin</option>';
                        echo '<option value="subscriber">Subscriber</option>';
                    }

                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" class="form-control" name="user_email"  value="<?php echo $user_row['user_email'] ?>">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" class="form-control" name="user_password" value="<?php echo $user_row['user_password'] ?>">
        </div>

        <div class="form-group">
            <input type="submit" name="update_user" value="Update User">
        </div>

    </form>

<?php
    }

?>