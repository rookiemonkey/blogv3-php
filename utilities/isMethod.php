<?php

    function isMethod($method=null) {
        if($_SERVER['REQUEST_METHOD'] === strtoupper($method)) {
            return true;
        }

        return false;
    }

?>