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
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>

            <?php AdminUsers::update_Current(); ?> 

            <?php

                if(isset($_SESSION['username'])) {
                    $mysqli = AdminModel::Provide_Database();
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
                            <input type="text" id="firstname" class="form-control" name="user_firstname" value="<?php echo $user_row['user_firstname'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" id="lastname" class="form-control" name="user_lastname" value="<?php echo $user_row['user_lastname'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" class="form-control" name="user_username" value="<?php echo $user_row['user_username'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="user_email"  value="<?php echo $user_row['user_email'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="user_password" value="<?php echo $user_row['user_password'] ?>" required readonly>
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

<?php AdminView::AdminFooter(); ?>  