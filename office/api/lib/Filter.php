<?php
include_once '../config.php';
include_once '../model/User.php';

class Filter
{
    function start() : Filter {
        session_start();
        error_reporting(log_level);
        return new Filter();
    }

    function returnJSON() : Filter
    {
        header('Content-Type: application/json');
        return $this;
    }

    function adminOnly() : Filter
    {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->values['is_admin']) {
                return $this;
            }
        }
        http_response_code(403);
        die('403');
    }
}
