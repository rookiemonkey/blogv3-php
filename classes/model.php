<?php

    require __DIR__ . '../../model/database.php';

    class Model {
        public static function Provide_Database() {
            return Initialize_Database();
        }
    }   
?>