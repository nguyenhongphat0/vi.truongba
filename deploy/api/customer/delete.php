<?php
include "../model/Customer.php";
include "../lib/Filter.php";

Filter::start()->adminOnly()->returnJSON();
$customer = new Customer($_GET);
echo $customer->delete() ? 'true' : 'false';