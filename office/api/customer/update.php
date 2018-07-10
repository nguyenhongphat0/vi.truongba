<?php
include "../model/Customer.php";
include "../lib/Filter.php";

Filter::start()->adminOnly()->returnJSON();
$_PUT = json_decode(file_get_contents('php://input'), true);
if (!isset($_PUT['name']) || trim($_PUT['name']) == '') {
    http_response_code(500);
    die('500');
}
$customer = new Customer($_PUT);
echo $customer->update()? 'true' : 'false';