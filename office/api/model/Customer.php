<?php
include_once '../lib/Model.php';

class Customer extends Model
{
    public static $table = "customers";
    public static $columns = ['id', 'name', 'organization', 'phone', 'address', 'date_created', 'description', 'email', 'avatar'];
    
    function __construct($param) {
        static::$default['date_created'] = date('Y-m-d H:i:s');
        parent::__construct($param);
    }
}