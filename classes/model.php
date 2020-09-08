<?php

    require __DIR__ . '../../includes/database.php';

    class Model {
        public static function Provide_Database() {
            return Initialize_Database();
        }
    }   
?>