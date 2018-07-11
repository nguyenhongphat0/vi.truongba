<?php
include "../model/Product.php";
include "../lib/Filter.php";

Filter::start()->returnJSON();
$product = (new Product($_GET))->find()->values;
if ($product['secret_key'] == $_GET['key']) {
    die($product['secret']);
}
http_response_code(403);
die('403');