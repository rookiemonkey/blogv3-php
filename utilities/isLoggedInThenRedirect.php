<?php

    function isLoggedInThenRedirect($location=null) {

        if(!$location) {
            exit('[isLoggedInThenRedirect]: Location parameter needed.');
        }

        if(isLoggedIn()) {
            redirect($location);
            exit;
        }
    }

?>