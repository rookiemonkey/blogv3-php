<?php

require_once __DIR__ . '/../../model/database.php';

class SubscriberModel
{
    public static function Provide_Database()
    {
        return Initialize_Database();
    }
}
