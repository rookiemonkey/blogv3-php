<?php

require __DIR__ . '/../../admin/controllers/category_create.php';
require __DIR__ . '/../../admin/controllers/category_update.php';
require __DIR__ . '/../../admin/controllers/category_delete.php';

class AdminCategories
{
    public static function create()
    {
        AdminUtilities::isAdmin();
        create_category();
    }
    public static function update()
    {
        AdminUtilities::isAdmin();
        update_category();
    }
    public static function delete()
    {
        AdminUtilities::isAdmin();
        delete_category();
    }
}
