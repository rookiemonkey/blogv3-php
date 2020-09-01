<?php

    include 'database.php';

    if(isset($_POST['login'])) {
        $username = $_POST["username"];
        $password = $_POST['password'];

        $query = $mysqli->prepare("SELECT * FROM users WHERE user_username = ?");
        $query->bind_param('s', $username);
        $query->execute();
        $users = $query->get_result();
        $query->close();
        
        if($users->num_rows === 0) {
            echo "Invalid username and password";
            die();
        }

        $row = $users->fetch_assoc();
        $db_user_id = $row['user_id'];
        $db_user_password = $row['user_password'];
        $db_user_username = $row['user_username'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];

        if($password !== $db_user_password) {
            header('Location: ../index.php');
        }

        else {
            session_start();
            $_SESSION['username'] = $db_user_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['role'] = $db_user_role;
            header('Location: ../admin');
        }
    }

?>