<?php

    function isAdmin() {

        $isAuthorized = $_SESSION['role'] === 'admin';

        if(!$isAuthorized) { header('Location: index.php'); die(); }

    }

?>