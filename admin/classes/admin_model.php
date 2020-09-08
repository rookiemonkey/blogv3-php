<?php

    require __DIR__ . '/../../includes/database.php';

    class AdminModel {
        public static function Provide_Database() {
            return Initialize_Database();
        }
    }

?>