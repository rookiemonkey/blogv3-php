<?php

    function isLoggedIn() {
        if(isset($_SESSION['role'])) {
            return true;
        }

        return false;
    }

?>