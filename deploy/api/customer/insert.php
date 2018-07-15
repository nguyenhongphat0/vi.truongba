<?php
include "../model/Customer.php";
include "../lib/Filter.php";

Filter::start()->adminOnly()->returnJSON();
$_POST = json_decode(file_get_contents('php://input'), true);
if (!isset($_POST['name']) || trim($_POST['name']) == '') {
    http_response_code(500);
    die('500');
}
$customer = new Customer($_POST);
echo $customer->insert() ? 'true' : 'false';