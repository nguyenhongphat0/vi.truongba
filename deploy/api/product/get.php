<?php
include "../model/Product.php";
include "../lib/Filter.php";

$product = (new Product($_GET))->find()->values;
if (!Filter::start()->returnJSON()->isAdmin()) {
    Product::hideSecret($product);
}
die(json_encode($product));