<?php
include "../model/Customer.php";
include "../lib/Filter.php";

Filter::start()->adminOnly()->returnJSON();
$customer = new Customer($_GET);
$customer->delete();
die('true');