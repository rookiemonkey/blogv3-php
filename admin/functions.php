<?php

    // utilities
    include './utilities/isAdmin.php';
    include './utilities/setOnlineUsers.php';
    include './utilities/renderAlert_success.php';
    include './utilities/renderAlert_failed.php';
    include './utilities/renderAlert_tablenoresult.php';












    // categories
    include './controllers/category_create.php';
    include './controllers/category_renderAll.php';
    include './controllers/category_update.php';
    include './controllers/category_delete.php';

    class Categories {
        public static function create() { isAdmin(); create_category(); }
        public static function read()   { isAdmin(); read_categories(); }
        public static function update() { isAdmin(); update_category(); }
        public static function delete() { isAdmin(); delete_category(); }
    }










    // posts
    include './controllers/post_bulk_options.php';
    include './controllers/posts_create.php';   
    include './controllers/posts_renderAll.php';
    include './controllers/posts_update.php';
    include './controllers/posts_delete.php';

    class Posts {
        public static function create()     { create_post(); }
        public static function read()       { isAdmin(); read_posts(); }
        public static function update()     { isAdmin(); update_post(); }
        public static function delete()     { isAdmin(); delete_post(); }
    }










    // comments
    include './controllers/comments_renderAll.php';
    include './controllers/comments_renderAllOfPost.php';
    include './controllers/comment_delete.php';
    include './controllers/comment_unapprove.php';
    include './controllers/comment_approve.php';

    class Comments {
        public static function read()           { isAdmin(); read_comments(); }
        public static function read_ofPost()    { isAdmin(); read_comments_ofpost(); }
        public static function delete()         { isAdmin(); delete_comment(); }
        public static function approve()        { isAdmin(); approve_comment(); }
        public static function unapprove()      { isAdmin(); unapprove_comment(); }
    }








    /**
     * conditional render of the update form
     */
    function update_renderForm() {
        global $mysqli;

        isAdmin();

        if(isset($_GET['update']) && $_GET['update'] === '') {
            echo "<div class='panel panel-danger'>";
            echo "<div class='panel-heading'>";
            echo "<h3 class='panel-title'>Category id is requied</h3>";
            echo "</div>";
            echo "</div>";
        }

        else if (isset($_GET['update'])) { 
            include './includes/update_category.php'; 
        }
    }











    /**
     * read all users and render them as a table
     */
    function read_users() {
        global $mysqli;

        isAdmin();

        // prepare statement and query
        $query = $mysqli->prepare("SELECT * FROM users");
        $query->execute();
        $users = $query->get_result();
        $query->close();
        
        // loop into the results and render
        while($row = $users->fetch_assoc()) {  
            echo "<tr>";
            echo "<td>{$row['user_id']}</td>";
            echo "<td>{$row['user_username']}</td>";
            echo "<td>{$row['user_firstname']}</td>";
            echo "<td>{$row['user_lastname']}</td>";
            echo "<td>{$row['user_email']}</td>";
            echo "<td>{$row['user_avatar']}</td>";
            echo "<td>{$row['user_role']}</td>";
            echo "<td><a href='./users.php?admin={$row['user_id']}'>To Admin</a></td>";
            echo "<td><a href='./users.php?subscriber={$row['user_id']}'>To Subscriber</a></td>";
            echo "<td><a href='./users.php?delete={$row['user_id']}'>Delete</a></td>";
            echo "<td><a href='./users.php?source=edit_user&u_id={$row['user_id']}'>Edit</a></td>";
            echo "</tr>";
        }
    }









    /**
     * create a user
     */
    function create_user() {
        global $mysqli;
        
        isAdmin();

        if(isset($_POST['create_user'])) {
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_username = $_POST['user_username'];
            $user_role = $_POST['user_role'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            $user_avatar = "test+image+page";
            $user_randSalt = "test+random+salt";

            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
            
            // prepare statement and query
            $query = $mysqli->prepare("INSERT INTO users (user_firstname, user_lastname, user_username, user_role, user_email, user_password, user_avatar, user_randSalt) VALUES (?,?,?,?,?,?,?,?)");
            $query->bind_param('ssssssss', $user_firstname, $user_lastname, $user_username, $user_role, $user_email, $user_password, $user_avatar, $user_randSalt);
            $result = $query->execute();

            // check if query is successfull
            if($result) { 
                echo "<div class='panel panel-success'>";
                echo "<div class='panel-heading'>";
                echo "<h3 class='panel-title'>Succesfully added a user</h3>";
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
            
            $query->close();
            
        }
    }









    /**
     * delete a user
     */
    function delete_user() {
        global $mysqli;

        isAdmin();

        if(isset($_GET['delete'])) {
            // prepare statement and query
            $user_id = intval($_GET['delete']);
            $query = $mysqli->prepare("DELETE FROM users WHERE user_id = ?");
            $query->bind_param('i', $user_id);
            $query->execute();
            $query->close();
            
            // refresh the page
            header("Location: users.php");
        }
    }








    /**
     * change role to admin
     */
    function update_user_toAdmin() {
        global $mysqli;

        isAdmin();

        if(isset($_GET['admin'])) {
            // prepare statement and query
            $user_id = intval($_GET['admin']);
            $user_role = 'admin';
            $query = $mysqli->prepare("UPDATE users SET user_role = ? WHERE user_id = ?");
            $query->bind_param('si', $user_role, $user_id);
            $query->execute();  
            $query->close();
            
            // refresh the page
            header("Location: users.php");
        }
    }










    /**
     * change role to subscriber
     */
    function update_user_toSubscriber() {
        global $mysqli;

        isAdmin();

        if(isset($_GET['subscriber'])) {
            // prepare statement and query
            $user_id = intval($_GET['subscriber']);
            $user_role = 'subscriber';
            $query = $mysqli->prepare("UPDATE users SET user_role = ? WHERE user_id = ?");
            $query->bind_param('si', $user_role, $user_id);
            $query->execute();  
            $query->close();
            
            // refresh the page
            header("Location: users.php");
        }
    }












    /**
     * update a user
     */
    function update_user() {
        global $mysqli;

        isAdmin();

        if(isset($_POST['update_user'])) {
            $user_id = intval($_GET['u_id']);
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_username = $_POST['user_username'];
            $user_role = $_POST['user_role'];
            $user_email = $_POST['user_email'];
            $user_avatar = "test+image+page";
            $user_randSalt = "test+random+salt";
            
            // prepare statement and query
            $query = $mysqli->prepare("UPDATE users SET user_firstname = ?, user_lastname = ?, user_username = ?, user_role = ?, user_email = ?, user_avatar = ?, user_randSalt = ? WHERE user_id = ?");
            $query->bind_param('ssssssss', $user_firstname, $user_lastname, $user_username, $user_role, $user_email, $user_avatar, $user_randSalt, $user_id);
            $result = $query->execute();

            // check if query is successfull
            if($result) { 
                header('Location: users.php');
            }
            else { 
                echo "<div class='panel panel-danger'>";
                echo "<div class='panel-heading'>";
                echo "<h3 class='panel-title'>Something went wrong. Please try again later</h3>";
                echo "</div>";
                echo "</div>";
            }
            
            $query->close();
            
        }
    }












    /**
     * update currently logged in user
     */
    function update_current_user() {
        global $mysqli;

        if(isset($_POST['update_user'])) {
            $current_user = $_SESSION['username'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_username = $_POST['user_username'];
            $user_role = $_POST['user_role'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            $user_avatar = "test+image+page";
            $user_randSalt = "test+random+salt";
            
            // prepare statement and query
            $query = $mysqli->prepare("UPDATE users SET user_firstname = ?, user_lastname = ?, user_username = ?, user_role = ?, user_email = ?, user_password = ?, user_avatar = ?, user_randSalt = ? WHERE user_username = ?");
            $query->bind_param('sssssssss', $user_firstname, $user_lastname, $user_username, $user_role, $user_email, $user_password, $user_avatar, $user_randSalt, $current_user);
            $result = $query->execute();

            // check if query is successfull
            if($result) { 
                header('Location: users.php');
            }
            else { 
                echo "<div class='panel panel-danger'>";
                echo "<div class='panel-heading'>";
                echo "<h3 class='panel-title'>Something went wrong. Please try again later</h3>";
                echo "</div>";
                echo "</div>";
            }
            
            $query->close();
            
        }
    }
?>