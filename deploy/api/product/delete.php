<?php
include "../model/Product.php";
include "../lib/Filter.php";

Filter::start()->adminOnly()->returnJSON();
$product = new Product($_GET);
echo $product->delete() ? 'true' : 'false';