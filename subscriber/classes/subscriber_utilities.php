<?php

require __DIR__ . '/../../subscriber/utilities/getRandomImage.php';
require __DIR__ . '/../../subscriber/utilities/renderAlert_success.php';
require __DIR__ . '/../../subscriber/utilities/renderAlert_failed.php';
require __DIR__ . '/../../subscriber/utilities/renderAlert_tablenoresult.php';
require __DIR__ . '/../../subscriber/utilities/renderModal_delete.php';
require __DIR__ . '/../../subscriber/utilities/renderOptions_author_create.php';
require __DIR__ . '/../../subscriber/utilities/renderOptions_poststatus_edit.php';
require __DIR__ . '/../../subscriber/utilities/renderOptions_category_edit.php';
require __DIR__ . '/../../subscriber/utilities/renderOptions_category_create.php';

class SubscriberUtilities
{
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

    public static function getRandomImage($path)
    {
        return getRandomImage($path);
    }

    public static function render_AuthorOptionsCreate()
    {
        render_authorOptions_create();
    }

    public static function render_PostStatusOptionsEdit($post_row)
    {
        render_poststatusOptions_edit($post_row);
    }

    public static function render_CategoryOptionsEdit($post_row)
    {
        render_categoryOptions_edit($post_row);
    }

    public static function render_CategoryOptionsCreate()
    {
        render_categoryOptions_create();
    }
}
