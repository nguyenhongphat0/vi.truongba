<?php
include "../model/Product.php";
include "../lib/Filter.php";

Filter::start()->adminOnly()->returnJSON();
$_POST = json_decode(file_get_contents('php://input'), true);
if (!isset($_POST['name']) || trim($_POST['name']) == '') {
    http_response_code(500);
    die('500');
}
$product = new Product($_POST);
echo $product->insert() ? 'true' : 'false';