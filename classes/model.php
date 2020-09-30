<?php

require_once __DIR__ . '../../model/database.php';

class Model
{
    public static function Provide_Database()
    {
        return Initialize_Database();
    }
}
