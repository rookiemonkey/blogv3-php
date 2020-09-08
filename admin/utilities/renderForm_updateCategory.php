<?php

    function update_renderForm() {
        $mysqli = AdminModel::Provide_Database();

        if(isset($_GET['update']) && $_GET['update'] === '') {
            AdminUtilities::alert_Failed('Category ID is required');
        }

        else if (isset($_GET['update'])) { 
            AdminView::CategoriesUpdateForm();
        }
    }

?>