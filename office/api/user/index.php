<?php
include "../model/User.php";
include "../lib/Filter.php";

Filter::start()->returnJSON()->adminOnly();
die(json_encode(User::all()));