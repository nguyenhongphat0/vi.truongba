<?php
include "../model/Product.php";
include "../lib/Filter.php";

Filter::start()->returnJSON();
$product = new Product($_GET);
die(json_encode($product->find()->values));