<?php

require __DIR__ . '/../../admin/utilities/isAdmin.php';
require __DIR__ . '/../../admin/utilities/renderAlert_success.php';
require __DIR__ . '/../../admin/utilities/renderAlert_failed.php';
require __DIR__ . '/../../admin/utilities/renderAlert_tablenoresult.php';
require __DIR__ . '/../../admin/utilities/renderModal_delete.php';
require __DIR__ . '/../../admin/utilities/renderForm_updateCategory.php';
require __DIR__ . '/../../admin/utilities/renderOptions_author_create.php';
require __DIR__ . '/../../admin/utilities/renderOptions_author_edit.php';
require __DIR__ . '/../../admin/utilities/renderOptions_category_create.php';
require __DIR__ . '/../../admin/utilities/renderOptions_category_edit.php';
require __DIR__ . '/../../admin/utilities/renderOptions_poststatus_edit.php';
require __DIR__ . '/../../admin/utilities/renderOptions_role_edit.php';

class AdminUtilities
{
    public static function isAdmin()
    {
        isAdmin();
    }

    public static function alert_Failed($message = 'Something went wrong. Please try again later')
    {
        renderalert_failed($message);
    }

    public static function alert_Success($message)
    {
        renderalert_success($message);
    }

    public static function alert_NoResults($message)
    {
        render_alert_tablenoresult($message);
    }

    public static function alert_Modal($id, $action, $message, $link)
    {
        render_modal($id, $action, $message, $link);
    }

    public static function render_UpdateCategoryForm()
    {
        update_renderForm();
    }

    public static function render_CategoryOptionsCreate()
    {
        render_categoryOptions_create();
    }

    public static function render_AuthorOptionsCreate()
    {
        render_authorOptions_create();
    }

    public static function render_CategoryOptionsEdit($post_row)
    {
        render_categoryOptions_edit($post_row);
    }

    public static function render_AuthorOptionsEdit($post_row)
    {
        render_authorOptions_edit($post_row);
    }

    public static function render_PostStatusOptionsEdit($post_row)
    {
        render_poststatusOptions_edit($post_row);
    }

    public static function render_RoleOptionsEdit($post_row)
    {
        render_roleOptions_edit($post_row);
    }
}
