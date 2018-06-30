<?php
include_once '../lib/Model.php';

class User extends Model
{
    public static $table = "users";
    public static $columns = ['id', 'username', 'password', 'email', 'is_admin'];
    
    function login() : bool {
        QueryBuilder::new()
        ->connect()
        ->prepare("SELECT id from users WHERE username = ? AND password = ?")
        ->param("ss", $this->values['username'], $this->values['password'])
        ->result($id)
        ->go()
        ->each(function($id) {
           $this->values['id'] = $id;
        });
        $this->find();
        $_SESSION['user'] = $this;
        return $id != null;
    }
}