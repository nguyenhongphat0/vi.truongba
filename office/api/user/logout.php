<?php
include "../model/User.php";
include "../lib/Filter.php";

Filter::start()->returnJSON();
session_unset();
die('true');