<?php

    // response to loadUsersOnline js ajax script to update the DOM every 1sec
    if(isset($_GET['onlineusers'])) {
        include '../includes/database.php';

        // query number of users online
        $query = $mysqli->prepare("SELECT * FROM users_online");
        $query->execute();
        $users_online = $query->get_result();
        $query->close();
        $users_online_count = $users_online->num_rows;
        echo $users_online_count;
    }






    // categories
    include './controllers/category_create.php';
    include './controllers/category_renderAll.php';
    include './controllers/category_update.php';
    include './controllers/category_delete.php';

    class Categories {
        public static function create() { create_category(); }
        public static function read() { read_categories(); }
        public static function update() { update_category(); }
        public static function delete() { delete_category(); }
    }





    // posts
    include './controllers/post_bulk_options.php';
    include './controllers/posts_create.php';   
    include './controllers/posts_renderAll.php';
    include './controllers/posts_update.php';
    include './controllers/posts_delete.php';

    class Posts {
        public static function create() { create_post(); }
        public static function read() { read_posts(); }
        public static function update() { update_post(); }
        public static function delete() { delete_post(); }
    }



















    /**
     * conditional render of the update form
     */
    function update_renderForm() {
        global $mysqli;

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
     * read all comments and render them as a table
     */
    function read_comments() {
        global $mysqli;

        // prepare statement and query
        $query = $mysqli->prepare("SELECT * FROM comments");
        $query->execute();
        $comments = $query->get_result();
        $query->close();
        
        // loop into the results and render
        while($row = $comments->fetch_assoc()) {  

            $query = $mysqli->prepare("SELECT * FROM posts WHERE post_id = ?");
            $query->bind_param('s', $row['comment_post']);
            $query->execute();
            $post = $query->get_result();
            $post_category_row = $post->fetch_assoc();

            echo "<tr>";
            echo "<td>{$row['comment_id']}</td>";
            echo "<td>{$row['comment_date']}</td>";
            echo "<td>{$row['comment_author']}</td>";
            echo "<td>{$row['comment_content']}</td>";
            echo "<td>{$row['comment_email']}</td>";
            echo "<td><a href='../post.php?p_id={$post_category_row['post_id']}'>{$post_category_row['post_title']}</a></td>";
            echo "<td>{$row['comment_status']}</td>";
            echo "<td><a href='comments.php?approve={$row['comment_id']}'>Approve</a></td>"; 
            echo "<td><a href='comments.php?unapprove={$row['comment_id']}'>Unapprove</a></td>"; 
            echo "<td><a href='comments.php?delete={$row['comment_id']}'>Delete</a></td>"; 
            echo "<td><a href='comments.php?update={$row['comment_id']}'>Update</a></td>";    
            echo "</tr>";

            $query->close();
        }
    }









    /**
     * delete a comment
     * admin/comments.php?delete=2
     */
    function delete_comment() {
        global $mysqli;

        if(isset($_GET['delete'])) {
            // prepare statement and query
            $comment_id = intval($_GET['delete']);
            $query = $mysqli->prepare("DELETE FROM comments WHERE comment_id = ?");
            $query->bind_param('i', $comment_id);
            $query->execute();
            $query->close();
            
            // refresh the page
            header("Location: comments.php");
        }
    }













    /**
     * unapproved a comment
     * admin/comments.php?unapprove=2
     */
    function unapprove_comment() {
        global $mysqli;

        if(isset($_GET['unapprove'])) {
            // prepare statement and query
            $comment_id = intval($_GET['unapprove']);
            $comment_status = 'unapproved';
            $query = $mysqli->prepare("UPDATE comments SET comment_status = ? WHERE comment_id = ?");
            $query->bind_param('si', $comment_status, $comment_id);

            // execute the query
            $result = $query->execute();

            // check if query is successfull
            if($result) { 
                // refresh the page
                header("Location: comments.php");
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
     * approve a comment
     * admin/comments.php?approve=2
     */
    function approve_comment() {
        global $mysqli;

        if(isset($_GET['approve'])) {
            // prepare statement and query
            $comment_id = intval($_GET['approve']);
            $comment_status = 'approved';
            $query = $mysqli->prepare("UPDATE comments SET comment_status = ? WHERE comment_id = ?");
            $query->bind_param('si', $comment_status, $comment_id);

            // execute the query
            $result = $query->execute();

            // check if query is successfull
            if($result) { 
                // refresh the page
                header("Location: comments.php");
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
     * read all users and render them as a table
     */
    function read_users() {
        global $mysqli;

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

        if(isset($_POST['create_user'])) {
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_username = $_POST['user_username'];
            $user_role = $_POST['user_role'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            $user_avatar = "test+image+page";
            $user_randSalt = "test+random+salt";
            
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