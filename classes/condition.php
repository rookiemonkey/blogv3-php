<?php

    class Condition extends Controller {
        public static function protect_forgot($method) {
            $request = $_SERVER['REQUEST_METHOD'] === strtoupper($method);
            if(!$request && !isset($_GET['token'])) {
                header("Location: index");
            }
        }

        public static function protect_login() {
            if(isset($_SESSION['id'])) {
                header("Location: index");
            }

            else if( $_SERVER['REQUEST_METHOD'] === 'POST' && 
                    !isset($_POST['username']) && 
                    !isset($_POST['password'])
            ) {
                header("Location: index");
            }

            else if(isset($_POST['username']) && 
                    isset($_POST['password'])
            )  {
                parent::login($_POST['username'], $_POST['password']);
            }
        }

        public static function protect_reset() {
            if(!isset($_GET['email']) && !isset($_GET['token'])) {
                header("Location: index");
            }
        }
    }
?>