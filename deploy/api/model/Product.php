<?php
include_once '../lib/Model.php';

class Product extends Model
{
    public static $table = "products";
    public static $columns = ['id', 'name', 'description', 'customer_id', 'date_created', 'image', 'status', 'secret', 'secret_key'];
    public static $secret_columns = ['secret', 'secret_key'];
    
    function __construct($param) {
        static::$default['date_created'] = date('Y-m-d H:i:s');
        parent::__construct($param);
    }

    static function hideSecret(&$product) {
        foreach (static::$secret_columns as $column) {
            $product[$column] = '';
        }
    }
}