<?php include './includes/admin_header.php' ?>  
    <div id="wrapper">

        <!-- Navigation -->
        <?php include './includes/admin_navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Profile Page
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                        <?php update_current_user() ?> 

                <?php

                    if(isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];
                        $query = $mysqli->prepare("SELECT * FROM users WHERE user_username = ?");
                        $query->bind_param('s', $username);
                        $query->execute();
                        $user = $query->get_result();
                        
                        $query->close();
                        
                        while($user_row = $user->fetch_assoc()) {
                
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
                                <label for="role" style="display: block;">Role</label>
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
                        }
                    ?>

                    </div>
                </div>

            </div>
        </div>
    </div>

<?php include "./includes/admin_footer.php" ?>