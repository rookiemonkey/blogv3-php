<?php

    require __DIR__ . '../../controllers/add_comment.php';
    require __DIR__ . '../../controllers/add_like.php';
    require __DIR__ . '../../controllers/reset_password.php';
    require __DIR__ . '../../controllers/register.php';
    require __DIR__ . '../../controllers/login.php';
    include __DIR__ . '../../controllers/logout.php';

    class Controller {
        public static function add_comment() { 
            if(isset($_POST['create_comment'])) { add_comment(); } 
        }

        public static function add_like() {
            if(isset($_POST['likedby'])) { add_like(); }
        }

        public static function reset_password($method) {
            $request = $_SERVER['REQUEST_METHOD'] === strtoupper($method);
            if($request && isset($_POST['recover-submit'])) { password_reset(); }
        }

        public static function register() {
             if(isset($_POST['submit_register'])) { 
                $info = register(); 

                if($info) {
                    self::login($info['username'], $info['password']);
                }
            }
        }

        public static function login($username, $password) {
            if(isset($_POST['login']) || isset($_POST['submit_register'])) { 
                login_user($username, $password); 
            }
        }

        public static function logout() {
            if(isset($_GET['logout'])) {
                logout();
            }
        }
    }
?>