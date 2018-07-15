<?php
include "../model/User.php";
include "../lib/Filter.php";

Filter::start()->returnJSON();
$user = new User($_GET);
if ($user->login()) {
    die('true');
} else {
    die('false');
}