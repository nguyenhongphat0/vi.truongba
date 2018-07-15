<?php
include "../model/Customer.php";
include "../lib/Filter.php";

Filter::start()->returnJSON();
$customer = new Customer($_GET);
die(json_encode($customer->find()->values));