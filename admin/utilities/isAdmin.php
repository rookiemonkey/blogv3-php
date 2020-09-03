<?php

    /**
     * simply checks if the currently logged in user
     * is an admin/authorized to access the route
     * if not, redirect to index page
     */

    function isAdmin() {

        $isAuthorized = $_SESSION['role'] === 'admin';

        if(!$isAuthorized) { header('Location: index.php'); die(); }

    }

?>