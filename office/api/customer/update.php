<?php
include "../model/Customer.php";
include "../lib/Filter.php";

Filter::start()->adminOnly()->returnJSON();
if (!isset($_GET['name'])) {
    die('500');
}
$customer = new Customer($_GET);
$customer->update();
die('true');