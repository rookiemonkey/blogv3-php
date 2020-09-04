<?php

    function register() {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_username = $_POST['user_username'];;  
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        if(empty($user_firstname) || empty($user_lastname) || empty($user_username) || empty($user_email) || empty($user_password)) {
            render_alert_failed('User informations cannot be empty');
        }

        else if (strlen($user_password) < 8) {
            render_alert_failed('Passwords should have a minimum of 8 charactes');
        }

        else if (is_user_exisiting($user_email, $user_username)){
            render_alert_failed('Username/Email already exists. Please provide a unique username and email');
        }

        else if (!is_user_exisiting($user_email, $user_username)) { 
            $inputs = [
                'firstname' => $user_firstname,
                'lastname' => $user_lastname,
                'username' => $user_username,
                'email' => $user_email,
                'password' => $user_password ,
                'role' => 'subscriber',
                'avatar' => 'test+avatar+jpg',
                'randSalt' => 'test+randsalt',
            ];

            // create the user's account
            $user_info = register_user($inputs);

            // login and start the session
            login_user($user_info['username'], $user_info['password']);

            // check if query is successfull
            if($user_info['result']) { 
                header('Location: index.php');
            }
            
            else { 
                render_alert_failed('Something went wrong. Please try again');
            }
        }
    }
?>