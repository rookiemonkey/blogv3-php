<?php

    function login_user($username, $password) {
        if( isset($_POST['username']) && 
            isset($_POST['password']) ||
            isset($_POST['submit_register'])
        ) {
            $mysqli = Model::Provide_Database();

            $query = $mysqli->prepare("SELECT * FROM users WHERE user_username = ?");
            $query->bind_param('s', $username);
            $query->execute();
            $users = $query->get_result();
            $query->close();
            
            if($users->num_rows === 0) {
                View::alert_Failed("Invalid username and password");
            }

            else {
                $row = $users->fetch_assoc();
                $db_user_id = $row['user_id'];
                $db_user_password = $row['user_password'];
                $db_user_username = $row['user_username'];
                $db_user_firstname = $row['user_firstname'];
                $db_user_lastname = $row['user_lastname'];
                $db_user_role = $row['user_role'];

                $isMatch = password_verify($password, $db_user_password);

                if(!$isMatch ) {
                    View::alert_Failed("Invalid username and password");
                }

                else {
                    session_start();

                    $session = session_id();
                    $time_out = time() - 60;

                    // insert as logged in user to users_online table
                    $query = $mysqli->prepare("INSERT INTO users_online (user_id, session, time) VALUES (?,?,?)");
                    $query->bind_param('iss', $db_user_id, $session, $time_out);
                    $query->execute();
                    $query->close();

                    $_SESSION['id'] = $db_user_id;
                    $_SESSION['username'] = $db_user_username;
                    $_SESSION['firstname'] = $db_user_firstname;
                    $_SESSION['lastname'] = $db_user_lastname;
                    $_SESSION['role'] = $db_user_role;

                    if($db_user_role === 'admin') {
                        header('Location: admin');
                    }

                    else {
                        header('Location: index');
                    }
                }
            }
        }
    }
?>