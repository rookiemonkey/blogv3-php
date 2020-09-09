<?php

    class Condition extends Controller {
        public static function protect_forgot() {
            if(!isset($_GET['token']) || isset($_SESSION['username'])) {
                header("Location: /cms/index");
            }
        }

        public static function protect_login() {
            if(isset($_SESSION['id'])) {
                $location = __DIR__ . "../../index.php";
                header("Location: /cms/index");
            }

            else if( $_SERVER['REQUEST_METHOD'] === 'POST' && 
                    !isset($_POST['username']) && 
                    !isset($_POST['password'])
            ) {
                 header("Location: /cms/index");
            }

            else if(isset($_POST['username']) && 
                    isset($_POST['password'])
            )  {
                parent::login($_POST['username'], $_POST['password']);
            }
        }

        public static function protect_reset() {
            if(!isset($_GET['email']) && !isset($_GET['token'])) {
                header("Location: /cms/index");
            }
        }
    }
?>