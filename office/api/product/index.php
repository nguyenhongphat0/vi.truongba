<?php
include "../model/Product.php";
include "../lib/Filter.php";

Filter::start()->returnJSON();
die(json_encode(Product::all()));