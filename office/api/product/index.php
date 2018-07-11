<?php
include "../model/Product.php";
include "../lib/Filter.php";

$products = Product::all();
if (!Filter::start()->returnJSON()->isAdmin()) {
    foreach ($products as &$product) {
        Product::hideSecret($product);
    }   
}
die(json_encode($products));