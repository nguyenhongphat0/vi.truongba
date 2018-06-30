<?php
include "../model/User.php";
include "../lib/Filter.php";

Filter::start()->returnJSON();
$user = $_SESSION['user'];
die(json_encode($user));