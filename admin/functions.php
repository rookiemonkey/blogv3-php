<?php

    /**
     * create a new category
     */
    function create_category() {
        global $mysqli;

        if(isset($_POST['add_category'])) {
            $category_title = $_POST['cat_title'];

            // validation
            if(empty($category_title)) { 
                echo "<div class='panel panel-danger'>";
                echo "<div class='panel-heading'>";
                echo "<h3 class='panel-title'>Category field is requied</h3>";
                echo "</div>";
                echo "</div>";
            }

            else {
                
                // prepare statement and query
                $category_title = mysqli_real_escape_string($mysqli, $category_title);
                $statement = "INSERT INTO categories (cat_title) VALUES (?)";
                $query = $mysqli->prepare($statement);
                $query->bind_param("s", $category_title);
                $result = $query->execute();

                // check if query is successfull
                if($result) { 
                    echo "<div class='panel panel-success'>";
                    echo "<div class='panel-heading'>";
                    echo "<h3 class='panel-title'>Succesfully added a category</h3>";
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

                // close the connection to the database
                $query->close();
            }
        }
    }





    /**
     * read all categories and 
     * render it as a table
     */
    function read_categories() {
        global $mysqli;

        $query = $mysqli->prepare("SELECT * FROM categories");
        $query->execute();
        $categories = $query->get_result();

        while($row = $categories->fetch_assoc()) {  
            $category_id = $row["cat_id"];
            $category_title = $row["cat_title"];
            echo "<tr>";
            echo "<td>{$category_id}</td>";     
            echo "<td>{$category_title}</td>";   
            echo "<td><a href='categories.php?delete={$category_id}'>Delete</a></td>"; 
            echo "<td><a href='categories.php?update={$category_id}'>Update</a></td>";    
            echo "</tr>";
        }

        $query->close();
    }







    /**
     * delete a category
     */
    function delete_category() {
        global $mysqli;

        if(isset($_GET['delete'])) {
            $category_id = $_GET['delete'];
            $category_id = mysqli_real_escape_string($mysqli, $category_id);
            $stmnt = "DELETE FROM categories WHERE cat_id = ?";
            $query = $mysqli->prepare($stmnt); 
            $query->bind_param("s", $category_id);
            $result = $query->execute();

            // check if query is successfull
            if($result) { 
                // refresh the page
                header("Location: categories.php");
            }
            else { 
                echo "<div class='panel panel-danger'>";
                echo "<div class='panel-heading'>";
                echo "<h3 class='panel-title'>Something went wrong. Please try again later</h3>";
                echo "</div>";
                echo "</div>";
                die(); 
            }

            $query->close();
        }
    }





    /**
     * update a category
     */

    function update_category() {
        global $mysqli;

        if(isset($_POST['update_category'])) {
            $category_title = $_POST['cat_title'];
            $category_id = $_GET['update'];

            // validation
            if(empty($category_title)) { 
                echo "<div class='panel panel-danger'>";
                echo "<div class='panel-heading'>";
                echo "<h3 class='panel-title'>Category field is requied</h3>";
                echo "</div>";
                echo "</div>";
            }

            else {
                // prepare statement and query
                $category_title = mysqli_real_escape_string($mysqli, $category_title);
                $statement = "UPDATE categories SET cat_title = ? WHERE cat_id = ?";
                $query = $mysqli->prepare($statement);
                $query->bind_param("ss", $category_title, $category_id);
                $result = $query->execute();

                // check if query is successfull
                if($result) { 
                    // refresh the page
                    header("Location: categories.php");
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
     * read all posts and render them as a table
     */
    function read_posts() {
        global $mysqli;

        // prepare statement and query
        $query = $mysqli->prepare("SELECT * FROM posts");
        $query->execute();
        $posts = $query->get_result();
        $query->close();
        
        // loop into the results and render
        while($row = $posts->fetch_assoc()) {  

            $query = $mysqli->prepare("SELECT * FROM categories WHERE cat_id = ?");
            $query->bind_param('s', $row['post_category_id']);
            $query->execute();
            $categories = $query->get_result();
            $post_category_row = $categories->fetch_assoc();

            echo "<tr>";
            echo "<td>{$row['post_id']}</td>";
            echo "<td>{$row['post_date']}</td>";
            echo "<td>{$row['post_author']}</td>";
            echo "<td><a href='../post.php?p_id={$row['post_id']}'>{$row['post_title']}</a></td>";
            echo "<td>{$post_category_row['cat_title']}</td>";
            echo "<td>{$row['post_status']}</td>";
            echo "<td><img src='../images/{$row['post_image']}' 
            alt='{$row['post_title']}' width='100' /></td>";
            echo "<td>{$row['post_tags']}</td>";
            echo "<td>{$row['post_comment_count']}</td>";
            echo "<td><a href='./posts.php?delete={$row['post_id']}'>Delete</a></td>";
            echo "<td><a href='./posts.php?source=edit_post&p_id={$row['post_id']}'>Edit</a></td>";
            echo "</tr>";

            $query->close();
        }
    }








    /**
     * create a post
     */
    function create_post() {
        global $mysqli;

        if(isset($_POST['create_post'])) {
            $post_title        = $_POST['post_title'];
            $post_author       = $_POST['post_author'];
            $post_category_id  = $_POST['post_category_id'];
            $post_status       = $_POST['post_status'];
            $post_tags         = $_POST['post_tags'];
            $post_content      = $_POST['post_content'];

            $post_image        = $_FILES['image']['name'];
            $post_image_temp   = $_FILES['image']['tmp_name'];
            $post_comment_count = 0;

            $post_date         = date("Y-m-d");

            // upload the image to the server
            define("UPLOAD_LOCATION", $_SERVER['DOCUMENT_ROOT'] . "/_PHP_blog/images/$post_image");
            move_uploaded_file($post_image_temp, UPLOAD_LOCATION);

            // prepare the statement
            $statement = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES (?,?,?,?,?,?,?,?,?)";
            $query = $mysqli->prepare($statement);

            // bind the parameters
            $query->bind_param("sssssssis", $post_category_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_comment_count, $post_status);

            // execute the query
            $result = $query->execute();

            // check if query is successfull
            if($result) { 
                echo "<div class='panel panel-success'>";
                echo "<div class='panel-heading'>";
                echo "<h3 class='panel-title'>Succesfully added a post</h3>";
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

            // close the connection to the database
            $query->close();
        }
    }









    /**
     * delete a post
     */
    function delete_post() {
        global $mysqli;

        if(isset($_GET['delete'])) {
            $post_id = $_GET['delete'];
            $post_id = mysqli_real_escape_string($mysqli, $post_id);
            $stmnt = "DELETE FROM posts WHERE post_id = ?";
            $query = $mysqli->prepare($stmnt); 
            $query->bind_param("s", $post_id);
            $result = $query->execute();

            // check if query is successfull
            if($result) { 
                // refresh the page
                header("Location: posts.php");
            }
            else { 
                echo "<div class='panel panel-danger'>";
                echo "<div class='panel-heading'>";
                echo "<h3 class='panel-title'>Something went wrong. Please try again later</h3>";
                echo "</div>";
                echo "</div>";
                die(); 
            }

            $query->close();
        }
    }











    /**
     * update a category
     */

    function update_post() {
        global $mysqli;

        if(isset($_POST['update_post'])) {
            $post_title = $_POST["post_title"];
            $post_category_id = $_POST['post_category_id'];
            $post_author = $_POST['post_author'];
            $post_status = $_POST['post_status'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];

            // escape string
            $post_title = mysqli_real_escape_string($mysqli, $post_title);
            $post_category_id = mysqli_real_escape_string($mysqli, $post_category_id);
            $post_author = mysqli_real_escape_string($mysqli, $post_author);
            $post_status = mysqli_real_escape_string($mysqli, $post_status);
            $post_tags = mysqli_real_escape_string($mysqli, $post_tags);
            $post_content = mysqli_real_escape_string($mysqli, $post_content);

            // prepare statement
            $statement = "UPDATE posts SET post_title = ?, post_category_id = ?, post_author = ?, post_status = ?, post_tags = ?, post_content = ? WHERE post_id = ?";
            $query = $mysqli->prepare($statement);

            // bind parameters
            $query->bind_param("sisssss", $post_title, $post_category_id, $post_author, $post_status, $post_tags, $post_content, $_GET['p_id']);

            // execute the query
            $result = $query->execute();

            // check if query is successfull
            if($result) { 
                // refresh the page
                header("Location: posts.php");
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
                echo "<h3 class='panel-title'>Succesfully added a post</h3>";
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
            $user_password = $_POST['user_password'];
            $user_avatar = "test+image+page";
            $user_randSalt = "test+random+salt";
            
            // prepare statement and query
            $query = $mysqli->prepare("UPDATE users SET user_firstname = ?, user_lastname = ?, user_username = ?, user_role = ?, user_email = ?, user_password = ?, user_avatar = ?, user_randSalt = ? WHERE user_id = ?");
            $query->bind_param('sssssssss', $user_firstname, $user_lastname, $user_username, $user_role, $user_email, $user_password, $user_avatar, $user_randSalt, $user_id);
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