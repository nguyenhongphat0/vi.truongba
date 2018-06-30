<?php
include '../lib/Model.php';

class User extends Model
{
    public static $table = "users";
    public static $columns = ['id', 'username', 'password', 'email', 'is_admin'];
}